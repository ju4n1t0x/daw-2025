<?php

namespace core;

use PDO;
use Exception;

class conexionVenta
{
    private static ?conexionVenta $instance = null;
    private PDO $connection;

    private function __construct(string $dbname = 'default')
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $password, $options);
        } catch (Exception $e) {
            throw new Exception("Error al conectar a la base de datos '{$dbname}': " . $e->getMessage());
        }
    }

    public static function getInstance(string $dbname = 'default'): conexionVenta
    {
        if (self::$instance === null) {
            self::$instance = new conexionVenta($dbname);
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

