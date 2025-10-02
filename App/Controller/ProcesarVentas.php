<?php

namespace App\Controller;


require_once __DIR__ . '/../../core/Databaseconnection.php';
require_once __DIR__ . '/../Service/VentaService.php';
require_once __DIR__ . '/../Model/Venta.php';

use App\Model\Venta;
use App\Service\VentaService;

class ProcesarVentas
{

    private VentaService $ventaService;

    public function __construct()
    {
        $this->ventaService = new VentaService();
    }

    public function agregarVenta()
    {
        try {
            // Leer el body como JSON
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Validar que se recibieron los datos
            if (!$data || !isset($data['fecha']) || !isset($data['cuit_cliente']) || !isset($data['monto'])) {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'error' => true,
                    'message' => 'Datos incompletos. Se requieren: fecha, cuit_cliente y monto'
                ]);
                return;
            }

            $fecha = $data['fecha'];
            $cuit_cliente = $data['cuit_cliente'];
            $monto = $data['monto'];

            // Convertir fecha de formato DD/MM/YYYY a YYYY-MM-DD
            $fechaParts = explode('/', $fecha);
            if (count($fechaParts) === 3) {
                $fecha = $fechaParts[2] . '-' . $fechaParts[1] . '-' . $fechaParts[0];
            }

            if ($this->ventaService->agregarVenta($fecha, $cuit_cliente, $monto)) {
                header('Content-Type: application/json');
                http_response_code(201); // Created
                echo json_encode([
                    'success' => true,
                    'message' => 'Venta registrada exitosamente',
                    'data' => [
                        'fecha' => $fecha,
                        'cuit_cliente' => $cuit_cliente,
                        'monto' => $monto
                    ]
                ]);
            } else {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al registrar la venta'
                ]);
            }
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function listarVentas()
    {
        try {
            $ventas = $this->ventaService->obtenerTodasLasVentas();

            header('Content-Type: application/json');
            echo json_encode($ventas);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function eliminarVenta()
    {
        error_log("=== INICIO eliminarVenta ===");
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data['id_venta'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'ID de venta no proporcionado.'
            ]);
            return;
        }

        $id_venta = $data['id_venta'];

        try {
            $ventaEliminada = $this->ventaService->eliminarVenta((int)$id_venta);
            if (!$ventaEliminada) {
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontró la venta con el ID proporcionado.',
                    'id_venta' => $id_venta
                ]);
                return;
            }
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Venta eliminada exitosamente.',
                'id_venta' => $id_venta
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
