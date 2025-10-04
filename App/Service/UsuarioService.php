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

    public function registrarUsuario($nombreUsuario, $email, $contrasena, $rol)
    {
        $contrasena_hash = $this->hashService->hashPassword($contrasena);
        $u = new Usuario(null, $nombreUsuario, $email, $contrasena_hash, $rol);

        $this->usuarioDao->save($u);
        echo 'Usuario registrado';
    }

    public function findByUsername($nombreUsuario)
    {
        return $this->usuarioDao->findByUsername($nombreUsuario);
    }
}
