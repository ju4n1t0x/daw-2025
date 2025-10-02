<?php

namespace App\Service;

require_once __DIR__ . '/IVentaService.php';
require_once __DIR__ . '/../Dao/VentaDAO.php';
require_once __DIR__ . '/../../core/Databaseconnection.php';


use App\Dao\VentaDAO;
use Exception;

class VentaService implements IVentaService
{
    private VentaDAO $ventaDAO;


    public function __construct()
    {
        $this->ventaDAO = new VentaDAO();
    }

    public function agregarVenta($fecha, $cuit_cliente, $monto)
    {
        if (empty($fecha) || empty($cuit_cliente) || !is_numeric($monto) || $monto <= 0) {
            throw new Exception("Datos de venta inválidos.");
        } else {
            try {
                return $this->ventaDAO->agregarVenta($fecha, $cuit_cliente, $monto);
            } catch (Exception $e) {
                throw new Exception("Error al agregar venta: " . $e->getMessage());
            }
        }
    }

    public function obtenerTodasLasVentas(): array
    {
        try {
            return $this->ventaDAO->obtenerTodasLasVentas();
        } catch (Exception $e) {
            throw new Exception("Error al obtener las ventas: " . $e->getMessage());
        }
    }


    public function eliminarVenta(int $id_venta): bool
    {
        try {
            return $this->ventaDAO->eliminarVenta($id_venta);
        } catch (Exception $e) {
            throw new Exception("Error al eliminar la venta: " . $e->getMessage());
        }
    }
}
