<?php

namespace App\Controller;

include_once __DIR__ . '/../OtherService/PasswordHashService.php';
include_once __DIR__ . '/../OtherService/TokenService.php';
include_once __DIR__ . '/../Dao/UsuarioDao.php';

use App\OtherService\TokenService;
use App\OtherService\PasswordHashService;
use App\Dao\UsuarioDao;

class AuthController {
    private UsuarioDao $dao;

    public function __construct() {
        $this->dao = new UsuarioDao();
    }

    public function login($nombreUsuario, $contrasena) {
        session_start();

        $u = $this->dao->findByUsername($nombreUsuario);

        if($u != null) {
            if(PasswordHashService::verifyPassword($contrasena, $u->getContrasena())) {
                $token = TokenService::generateToken($u);

                $_SESSION['token'] = $token;

                header("Location: Views/welcome.php");
                exit();
            } else {
                header("Location: Views/login.php?error=contrasena_incorrecta");
            }
        } else {
            header("Location: Views/login.php?error=usuario_no_encontrado");
        }
    }

}