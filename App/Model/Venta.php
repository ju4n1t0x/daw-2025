<?php

namespace App\Model;

class Venta {
    private ?int $id_venta;
    private string $fecha;
    private string $cuit_cliente; // Corregido de ?int a string
    private float $monto;

    public function __construct(?int $id_venta, string $fecha, string $cuit_cliente, float $monto) {
        $this->id_venta = $id_venta;
        $this->fecha = $fecha;
        $this->cuit_cliente = $cuit_cliente;
        $this->monto = $monto;
    }

    public function getIdVenta(): ?int {
        return $this->id_venta;
    }

    public function getFecha(): string {
        return $this->fecha;
    }

    public function getCuitCliente(): string {
        return $this->cuit_cliente;
    }

    public function getMonto(): float {
        return $this->monto;
    }

    public function setIdVenta(?int $id_venta): void {
        $this->id_venta = $id_venta;
    }

    public function setFecha(string $fecha): void {
        $this->fecha = $fecha;
    }

    public function setCuitCliente(string $cuit_cliente): void {
        $this->cuit_cliente = $cuit_cliente;
    }

    public function setMonto(float $monto): void {
        $this->monto = $monto;
    }
}


