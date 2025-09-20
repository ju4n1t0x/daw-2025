<?php

namespace App\Model;

class Usuario {
    private ?int $id;
    private $nombreUsuario;
    private $email;
    private $contrasena;

    private $role;

    public function __construct(?int $id, $nombreUsuario, $email, $contrasena, string $role = 'user') {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getRole() {
        return $this->role;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setRole($role) {
        $this->rol = $role;
    }
}
