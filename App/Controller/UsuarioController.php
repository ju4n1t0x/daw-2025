<?php

namespace App\Controller;

include_once __DIR__ . '/../Service/UsuarioService.php';

use App\Service\UsuarioService;

class UsuarioController
{
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
    }

    public function registrarUsuario()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data || !isset($data['nombre_usuario']) || !isset($data['email']) || !isset($data['contrasena']) || !isset($data['rol'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'Datos incompletos. Se requieren: nombre_usuario, email, contrasena y rol'
            ]);
            return;
        }
        $this->usuarioService->registrarUsuario($data['nombre_usuario'], $data['email'], $data['contrasena'], $data['rol']);
    }

    public function listarUsuarios()
    {
        try {
            $usuarios = $this->usuarioService->obtenerTodosLosUsuarios();
            $usuariosArray = array_map(function ($usuario) {
                return [
                    'id' => $usuario->getId(),
                    'nombre_usuario' => $usuario->getNombreUsuario(),
                    'email' => $usuario->getEmail(),
                    'contrasena' => $usuario->getContrasena(),
                    'rol' => $usuario->getRol()
                ];
            }, $usuarios);
            header('Content-Type: application/json');
            echo json_encode($usuariosArray);
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => 'Error al listar usuarios: ' . $e->getMessage()
            ]);
        }
    }
}
