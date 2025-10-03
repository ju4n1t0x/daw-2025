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

    public function agregarVenta(Venta $ventaModel): bool
    {
        $sql = "INSERT INTO ventas (fecha, cuit_cliente, monto) VALUES (:fecha, :cuit_cliente, :monto)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'fecha' => $ventaModel->getFecha(),
            'cuit_cliente' => $ventaModel->getCuitCliente(),
            'monto' => $ventaModel->getMonto()
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

    public function obtenerVentaPorId(int $id_venta): ?Venta
    {
        $sql = "SELECT * FROM ventas WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_venta' => $id_venta]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Venta(
                $row['id_venta'],
                $row['fecha'],
                $row['cuit_cliente'],
                $row['monto']
            );
        }
        return null;
    }
}
