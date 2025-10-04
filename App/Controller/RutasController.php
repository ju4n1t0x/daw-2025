<?php

namespace App\Controller;


require_once __DIR__ . '/../lib/Route.php';
require_once __DIR__ . '/ProcesarVentas.php';
require_once __DIR__ . '/AuthController.php';
require_once __DIR__ . '/UsuarioController.php';

use App\lib\Route;
use App\Controller\ProcesarVentas;
use App\Controller\AuthController;
use App\Controller\UsuarioController;

class RutasController
{

    private ProcesarVentas $procesarVentas;
    private AuthController $authController;
    private UsuarioController $usuarioController;


    public function __construct()
    {
        $this->procesarVentas = new ProcesarVentas();
        $this->authController = new AuthController();
        $this->usuarioController = new UsuarioController();
    }

    public function index()
    {
        session_start();

        $procesarVentas = $this->procesarVentas;
        $usuarioController = $this->usuarioController;
        $authController = $this->authController;


        Route::get('/', function () {
            echo "Home Page";
        });
        Route::post('/login', function () use ($authController) {
            $authController->login();
        });

        Route::get('/ventas', function () use ($procesarVentas) {
            $procesarVentas->listarVentas();
        });
        Route::post('/ventas', function () use ($procesarVentas) {
            $procesarVentas->agregarVenta();
        });
        Route::delete('/ventas', function () use ($procesarVentas) {
            $procesarVentas->eliminarVenta();
        });
        Route::get('/users', function () {
            echo "Users Page";
        });
        Route::post('/users', function () use ($usuarioController) {
            $usuarioController->registrarUsuario();
        });
        Route::put('/users', function () {
            echo "Users Put";
        });

        Route::dispatch();
    }
}
