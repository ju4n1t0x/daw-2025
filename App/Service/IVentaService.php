<?php

namespace App\Service;

use App\Model\Venta;

interface IVentaService {
    public function agregarVenta(Venta $venta): bool;
    public function obtenerTodasLasVentas(): array;
    public function actualizarVenta(Venta $venta): bool;
    public function eliminarVenta(int $id_venta): bool;
}
