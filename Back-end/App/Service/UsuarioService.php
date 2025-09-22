<?php

namespace App\Service;

require_once __DIR__ . '/../Dao/UsuarioDao.php';
require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../OtherService/PasswordHashService.php';

use App\Dao\UsuarioDao;
use App\Model\Usuario;
use App\OtherService\PasswordHashService;

class UsuarioService {
    private UsuarioDao $dao;

    private PasswordHashService $hashService;

    public function __construct() {
        $this->dao = new UsuarioDao();
        $this->hashService = new PasswordHashService();
    }

    public function registrarUsuario($nombreUsuario, $email, $contrasena, $rol) {
        $contrasena_hash = $this->hashService->hashPassword($contrasena);
        $u = new Usuario(null ,$nombreUsuario, $email, $contrasena_hash, $rol);

        $this->dao->save($u);
        echo 'Usuario registrado';
    }

}