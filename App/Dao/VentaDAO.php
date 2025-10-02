<?php

namespace App\Dao;

require_once __DIR__ . '/../../core/Databaseconnection.php';
require_once __DIR__ . '/../Model/Venta.php';

use App\Model\Venta;
use core\DatabaseConnection;
use PDO;

class VentaDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    public function agregarVenta($fecha, $cuit_cliente, $monto): bool
    {
        $sql = "INSERT INTO ventas (fecha, cuit_cliente, monto) VALUES (:fecha, :cuit_cliente, :monto)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'fecha' => $fecha,
            'cuit_cliente' => $cuit_cliente,
            'monto' => $monto
        ]);
    }

    public function obtenerTodasLasVentas(): array
    {
        $sql = "SELECT * FROM ventas ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $ventas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ventas[] = new Venta(
                $row['id_venta'],
                $row['fecha'],
                $row['cuit_cliente'],
                $row['monto']
            );
        }
        return $ventas;
    }

    public function eliminarVenta(int $id_venta): bool
    {
        $sql = "DELETE FROM ventas WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_venta' => $id_venta]);
    }
}
