<?php

namespace App\Dao;

require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../../core/Databaseconnection.php';

use App\Model\Usuario;
use core\DatabaseConnection;
use PDO;

class UsuarioDao
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function save(Usuario $u)
    {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_usuario, email, contrasena, rol) VALUES (:nombre_usuario, :email, :contrasena, :rol)');

        $stmt->execute([
            ':nombre_usuario' => $u->getNombreUsuario(),
            ':email' => $u->getEmail(),
            ':contrasena' => $u->getContrasena(),
            ':rol' => $u->getRol()
        ]);

        return $this->pdo->lastInsertId();
    }


    public function findByUsername($nombre_usuario): ?Usuario
    {

        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario LIMIT 1');

        $stmt->execute([
            ':nombre_usuario' => $nombre_usuario,
        ]);

        $f = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($f === false) {
            return null;
        }

        return new Usuario($f['id'], $f['nombre_usuario'], $f['email'], $f['contrasena'], $f['rol']);
    }

    public function obtenerTodosLosUsuarios(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios ORDER BY id ASC');
        $stmt->execute();
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario(
                $row['id'],
                $row['nombre_usuario'],
                $row['email'],
                $row['contrasena'],
                $row['rol']
            );
        }
        return $usuarios;
    }
}
