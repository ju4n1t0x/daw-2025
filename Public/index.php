<?php


require_once __DIR__ . '/../App/Controller/RutasController.php';

use App\Controller\RutasController;

$rutasController = new RutasController();

$rutasController->index();
