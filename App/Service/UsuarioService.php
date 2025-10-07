<?php


namespace App\Service;

require_once __DIR__ . '/../Dao/UsuarioDao.php';
require_once __DIR__ . '/PasswordHashService.php';

use App\Dao\UsuarioDao;
use App\Model\Usuario;
use App\Service\PasswordHashService;

class UsuarioService
{
    private UsuarioDao $usuarioDao;

    private PasswordHashService $hashService;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
        $this->hashService = new PasswordHashService();
    }

    public function registrarUsuario($nombre_usuario, $email, $contrasena, $rol)
    {
        if ($this->usuarioDao->findByUsername($nombre_usuario)) {
            echo "El nombre de usuario ya existe.";
        } else {
            try {
                $contrasena_hash = $this->hashService->hashPassword($contrasena);
                $u = new Usuario(null, $nombre_usuario, $email, $contrasena_hash, $rol);
                $this->usuarioDao->save($u);
                echo 'Usuario registrado';
            } catch (\Exception $e) {
                throw new \Exception("Error al registrar usuario: " . $e->getMessage());
            }
        }
    }

    public function findByUsername($nombre_usuario)
    {
        if (!empty($nombre_usuario) && is_string($nombre_usuario)) {
            return $this->usuarioDao->findByUsername($nombre_usuario);
        } else {
            return null;
        }
    }
    public function obtenerTodosLosUsuarios()
    {
        try {
            return $this->usuarioDao->obtenerTodosLosUsuarios();
        } catch (\Exception $e) {
            throw new \Exception("No se pudieron obtener los usuarios: " . $e->getMessage());
        }
    }
}
