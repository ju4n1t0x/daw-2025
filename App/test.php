<?php

include_once __DIR__ . '/Controller/AuthController.php';
include_once __DIR__ . '/OtherService/TokenService.php';

use \App\Controller\AuthController;

$authController = new AuthController();

if (isset($_POST['submit'])) {
    $nombreUsuario = $_POST['nombreUsuario'];
    $contrasena = $_POST['contrasena'];

    $authController->login($nombreUsuario, $contrasena);
}

