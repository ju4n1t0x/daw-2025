<?php

namespace Database;

class Config {
    private $host='localhost';
    private $user='root';
    private $pass='';
    private $db='TpDaw';

    private function __construct(){}

    private static ?Config $instance = null;
    public static function getInstance(): Config{
        static $instance = null;
        if ($instance == null){
            $instance = new Config();
        }
        return $instance;
    }

    public function getHost(): string{
        return $this->host;
    }
    public function getUser(): string{
        return $this->user;
    }
    public function getPass(): string{
        return $this->pass;
    }
    public function getDb(): string{
        return $this->db;
    }

}


?>
