<?php

header('Access-Control-Allow-Origin: http://localhost:3000'); // Indicamos al navegador que pueden venir peticiones desde cualquier servicio
header('Access-Control-Allow-Credentials: true'); // Indicamos que el backend acepta cookies
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS'); // especificamos que metodos estan permitidos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // escificamos que headers va a poder enviar le front end
header('Content-Type: application/json'); // indicamos al navegador que todas las respuestas van a ser en formato JSON 

// Prefligth request - comprobamos primero si el backend permite la peticion antes de enviarla
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/../App/Controller/RutasController.php';

use App\Controller\RutasController;

$rutasController = new RutasController();

$rutasController->index();
