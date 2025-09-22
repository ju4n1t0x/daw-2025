<?php

use App\Service\UsuarioService;

require_once __DIR__ . '/App/Service/UsuarioService.php';

$usuarioService = new UsuarioService();
$usuarioService->registrarUsuario('Juan Ignacio', 'juan@gmail.com', '12345678', 'admin');




?>