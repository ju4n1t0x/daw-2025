<?php

namespace App\Dao;

require_once __DIR__ . '/../Model/Usuario.php';

use App\Model\Usuario;
use PDO;

class UsuarioDao {
    protected $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function save(Usuario $u) {
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_usuario, email, contrasena, role) VALUES (:nombreUsuario, :email, :contrasena, :role)');

        $stmt->execute([
            ':nombreUsuario' => $u->getNombreUsuario(),
            ':email' => $u->getEmail(),
            ':contrasena' => $u->getContrasena(),
            ':role' => $u->getRole()
        ]);

        return $this->pdo->lastInsertId();
    }

    public function update(Usuario $u) {
        $stmt = $this->pdo->prepare('UPDATE usuarios SET nombre_usuario = :nombreUsuario, email = :email, contrasena = :contrasena, rol = :role WHERE id = :id');

        $stmt->execute([
            ':id' => $u->getId(),
            ':nombreUsuario' => $u->getNombreUsuario(),
            ':email' => $u->getEmail(),
            ':contrasena' => $u->getContrasena(),
            ':role' => $u->getRole()
        ]);
    }

    public function findByUsername($nombreUsuario) : ?Usuario {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :nombreUsuario LIMIT 1');

        $stmt->execute([
            ':nombreUsuario' => $nombreUsuario,
        ]);

        $f = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($f === false) {
            return null;
        }

        return new Usuario($f['id'], $f['nombre_usuario'], $f['email'], $f['contrasena'], $f['role']);
    }

}


