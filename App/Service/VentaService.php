<?php

namespace App\Service;

require_once __DIR__ . '/IVentaService.php';
require_once __DIR__ . '/../Dao/VentaDAO.php';
require_once __DIR__ . '/../../core/Databaseconnection.php';
require_once __DIR__ . '/../Model/Venta.php';


use App\Dao\VentaDAO;
use Exception;
use App\Model\Venta;


class VentaService
{
    private VentaDAO $ventaDAO;
    private Venta $ventaModel;


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
                $ventaModel = new Venta(null, $fecha, $cuit_cliente, $monto);
                return $this->ventaDAO->agregarVenta($ventaModel);
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
        $buscarVenta = $this->ventaDAO->obtenerVentaPorId($id_venta);
        if ($buscarVenta !== null) {
            try {
                return $this->ventaDAO->eliminarVenta($id_venta);
            } catch (Exception $e) {
                throw new Exception("La venta no pudo eliminarse correctamente " . $e->getMessage());
            }
        } else {
            throw new Exception("La venta con ID " . $id_venta . " no existe.");
        }
    }
}
