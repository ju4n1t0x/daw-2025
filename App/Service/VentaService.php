<?php

namespace App\Service;

require_once __DIR__ . '/IVentaService.php';
require_once __DIR__ . '/../Dao/VentaDAO.php';
require_once __DIR__ . '/../../core/conexionVenta.php';
require_once __DIR__ . '/../Model/Venta.php';

use App\Dao\VentaDAO;
use App\Model\Venta;
use core\conexionVenta;
use PDO;
use Exception;

class VentaService implements IVentaService
{
    private VentaDAO $ventaDAO;
    private PDO $dbConnection;

    public function __construct()
    {
        try {
            $this->dbConnection = conexionVenta::getInstance('db_ventas')->getConnection();
            $this->ventaDAO = new VentaDAO($this->dbConnection);
        } catch (Exception $e) {
            throw new Exception("No se pudo establecer la conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function agregarVenta(Venta $venta): bool
    {
        try {
            return $this->ventaDAO->agregarVenta($venta);
        } catch (Exception $e) {
            throw new Exception("Error al agregar venta: " . $e->getMessage());
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

    public function actualizarVenta(Venta $venta): bool
    {
        try {
            return $this->ventaDAO->actualizarVenta($venta);
        } catch (Exception $e) {
            throw new Exception("Error al actualizar la venta: " . $e->getMessage());
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






