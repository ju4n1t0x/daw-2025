<?php

namespace Database;
require_once __DIR__ . '/../Config/DbConfig.php';

use PDO;

class DatabaseConection {

    private static ?DatabaseConection $instance = null;
    private PDO $conection;

    private function __construct(){
        $config = Config::getInstance();

        $this->conection = new PDO("mysql:host=".$config->getHost() . ";dbname=" . $config->getDb(),
            $config->getUser(), $config->getPass());
        $this->conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): DatabaseConection
    {
        if(self::$instance === null){
            self::$instance = new DatabaseConection();
        }
        return self::$instance;
    }

    public function getConection(): PDO
    {
        return $this->conection;
    }

    private function __clone(){}
}
?>