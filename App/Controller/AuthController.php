<?php

namespace App\Controller;

include_once __DIR__ . '/../Service/PasswordHashService.php';
include_once __DIR__ . '/../Service/TokenService.php';

include_once __DIR__ . '/../Service/UsuarioService.php';


use App\Service\TokenService;
use App\Service\PasswordHashService;
use App\Service\UsuarioService;

class AuthController
{
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function login()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $nombreUsuario = $data['nombreUsuario'];
        $contrasena = $data['contrasena'];
        session_start();

        $usuario = $this->usuarioService->findByUsername($nombreUsuario);

        if ($usuario != null) {
            if (PasswordHashService::verifyPassword($contrasena, $usuario->getContrasena())) {
                try {

                    $token = TokenService::generateToken($usuario);

                    $_SESSION['token'] = $token;
                    $_SESSION['usuario'] = $usuario->getNombreUsuario();

                    header('Content-Type: application/json');
                    http_response_code(300);
                    echo json_encode([
                        'success' => true,
                        'message' => 'Inicio de sesión exitoso',
                        'token' => $token
                    ]);
                    return;
                } catch (\Exception $e) {
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode([
                        'error' => $e->getMessage(),
                        'message' => 'Error al generar el token'
                    ]);
                    return;
                }
            } else {
                header('Content-Type: application/json');
                http_response_code(401);
                echo json_encode([
                    'error' => true,
                    'message' => 'Credenciales inválidas'
                ]);
                return;
            }
        }
    }
}
