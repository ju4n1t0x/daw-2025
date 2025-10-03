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

        if (!$data || !isset($data['nombreUsuario']) || !isset($data['email']) || !isset($data['contrasena'])) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'Datos incompletos. Se requieren: nombreUsuario, email y contrasena'
            ]);
            return;
        }
        $this->usuarioService->registrarUsuario($data['nombreUsuario'], $data['email'], $data['contrasena'], $data['rol']);
    }
}
