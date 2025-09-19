<?php

namespace App\Clientes;

class Cliente{

    private $dni;
    private $nombre;
    private $apellido;
    private $fecha_nacimiento;
    private $email;
    private $telefono;
    private $direccion =[
        'calle',
        'numero',
        'ciudad',
        'provincia'
    ];
    private $fecha_alta;
    private $contraseña;


    public function __construct($dni, $nombre, $apellido, $fecha_nacimiento, $email, $telefono, array $direccion, $fecha_alta, $contraseña)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->fecha_alta = $fecha_alta;
        $this->contraseña = $contraseña;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getFechaAlta(){
        return $this->fecha_alta;
    }

    public function setFechaAlta($fecha_alta){
        $this->fecha_alta = $fecha_alta;
    }


}