<?php

namespace App\Controller;

include_once __DIR__ . '/../OtherService/PasswordHashService.php';
include_once __DIR__ . '/../OtherService/TokenService.php';

include_once __DIR__ . '/../Service/UsuarioService.php';

use App\Model\Usuario;
use App\OtherService\TokenService;
use App\OtherService\PasswordHashService;
use App\Service\UsuarioService;

class AuthController
{
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function login($nombreUsuario, $contrasena)
    {
        $u = $this->usuarioService->findByUsername($nombreUsuario);

        if ($u != null) {
            if (PasswordHashService::verifyPassword($contrasena, $u->getContrasena())) {
                $token = TokenService::generateToken($u);

                $_SESSION['token'] = $token;

                header("Location: Views/welcome.php");
                exit();
            } else {
                header("Location: Views/login.php");
            }
        }
    }
}
