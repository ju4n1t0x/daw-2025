<?php

namespace App\Model;

class Usuario implements \JsonSerializable
{
    private ?int $id;
    private $nombreUsuario;
    private $email;
    private $contrasena;

    private $rol;

    public function __construct(?int $id, $nombreUsuario, $email, $contrasena, string $rol = 'user')
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    }

    public function setRole($rol)
    {
        $this->rol = $rol;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'nombreUsuario' => $this->nombreUsuario,
            'email' => $this->email,
            'contrasena' => $this->contrasena,
            'rol' => $this->rol
        ];
    }
}
