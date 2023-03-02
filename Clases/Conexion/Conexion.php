<?php

namespace Clases\Conexion;

use PDO;
use PDOException;

class Conexion
{
    private $server;
    private $user;
    private $password;
    private $dataBase;
    private $port;
    static private $instantiate;


    private function __construct()
    {
        $this->loadAttributes();
        try {
            $dsn = "mysql:dbname = {$this->dataBase}; host = {$this->server}; port = {$this->port}";
            self::$instantiate = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $ex) {
            echo "Error de Conexion: {$ex->getMessage()}";
        }
    }

    private function dataConnection(): array
    {
        $address = dirname(__FILE__);
        $jsondata = file_get_contents($address . "/" . "config");
        return json_decode($jsondata, true);
    }

    public function execute(): Conexion
    {
        if (self::$instantiate == null) {
            self::$instantiate = new Conexion();
        }
        return self::$instantiate;
    }

    private function loadAttributes(): void
    {
        $connectionDataList = $this->dataConnection();

        foreach ($connectionDataList as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->dataBase = $value['dataBase'];
            $this->port = $value['port'];
        }
    }
}
