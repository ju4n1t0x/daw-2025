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

        if (!isset($data['nombreUsuario']) || !isset($data['contrasena'])) {
            $this->enviarError(400, 'Faltan credenciales: nombreUsuario y contrasena son requeridos');
            return;
        }
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

                    $this->enviarExito(200, [
                        'success' => true,
                        'message' => 'Login exitoso',
                        'token' => $token,
                        'usuario' => $usuario->getNombreUsuario(),
                        'role' => $usuario->getRol()
                    ]);
                    return;
                } catch (\Exception $e) {
                    $this->enviarError(500, 'Error al generar el token: ' . $e->getMessage());
                    return;
                }
            } else {
                $this->enviarError(401, 'Contraseña incorrecta');
                return;
            }
        } else {

            $this->enviarError(401, 'Usuario no encontrado');
            return;
        }
    }

    private function enviarExito($code, $data)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($data);
    }
    private function enviarError($code, $mensaje)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode([
            'error' => true,
            'message' => $mensaje
        ]);
    }
}
