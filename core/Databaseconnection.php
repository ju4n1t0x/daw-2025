<?php

namespace core;

use PDO;
use PDOException;

class DatabaseConnection {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'mysql:host=localhost;dbname=tpdaw;';
        $username = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO($host, $username, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('DatabaseConnection error' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function __clone() {

    }

    public function __wakeup(){

    }
}
