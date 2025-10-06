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

        if (!isset($data['nombre_usuario']) || !isset($data['contrasena'])) {
            $this->enviarError(400, 'Faltan credenciales: nombre_usuario y contrasena son requeridos');
            return;
        }
        $nombre_usuario = $data['nombre_usuario'];
        $contrasena = $data['contrasena'];
        session_start();

        $usuario = $this->usuarioService->findByUsername($nombre_usuario);

        if ($usuario != null) {
            if (PasswordHashService::verifyPassword($contrasena, $usuario->getContrasena())) {
                try {

                    $token = TokenService::generateToken($usuario);

                    $_SESSION['token'] = $token;
                    $_SESSION['usuario'] = $usuario->getNombreUsuario();

                    setcookie('auth_token', $token, [
                        'expires' => time() + 3600, // 1 hora
                        'path' => '/',
                        'httponly' => true, // Solo accesible vía HTTP (no JavaScript)
                        'samesite' => 'Lax' // Protección CSRF básica
                    ]);

                    $this->enviarExito(200, [
                        'success' => true,
                        'message' => 'Login exitoso',
                        'token' => $token,
                        'usuario' => $usuario->getNombreUsuario(),
                        'rol' => $usuario->getRol()
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

    public static function validarToken()
    {
        // Leer el token desde la cookie
        if (!isset($_COOKIE['auth_token'])) {
            http_response_code(401);
            echo json_encode(['error' => 'No autorizado - Token no encontrado']);
            exit;
        }

        $token = $_COOKIE['auth_token'];
        $decoded = TokenService::validateToken($token);

        if (!$decoded) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido o expirado']);
            exit;
        }

        return $decoded;
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
