<?php

namespace App\lib;

class Route
{

    private static $routes = [];



    public static function get($uri, $callback)
    {

        self::$routes['GET'][$uri] = $callback;
    }
    public static function post($uri, $callback)
    {

        self::$routes['POST'][$uri] = $callback;
    }
    public static function put($uri, $callback)
    {

        self::$routes['PUT'][$uri] = $callback;
    }
    public static function delete($uri, $callback)
    {

        self::$routes['DELETE'][$uri] = $callback;
    }

    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $basePath = '/daw2025/TP/Public';
        $uri = str_replace($basePath, '', $uri);

        // Separar la URI de los parámetros de query string
        $uriParts = explode('?', $uri);
        $uri = $uriParts[0];

        $uri = trim($uri, '/');

        if (empty($uri)) {
            $uri = '/';
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes[$method] as $route => $callback) {
            // Normalizar la ruta registrada también
            $normalizarRuta = trim($route, '/');
            if (empty($normalizarRuta)) {
                $normalizarRuta = '/';
            }

            if ($normalizarRuta == $uri) {
                $callback();
                return;
            }
        }

        echo '404 Not Found';
    }
}
