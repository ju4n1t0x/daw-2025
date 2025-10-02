<?php

namespace App\Service;

use App\Model\Venta;

interface IVentaService
{
    public function agregarVenta($fecha, $cuit_cliente, $monto);
    public function obtenerTodasLasVentas(): array;
    public function eliminarVenta(int $id_venta): bool;
}
