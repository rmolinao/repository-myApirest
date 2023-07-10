<?php

namespace Modelos\Conexion;

use PDO;
use PDOException;
use DAO\Interfaces\IConexion;
use Exception;

class Conexion implements IConexion
{
    private $server;
    private $user;
    private $password;
    private $dataBase;
    private $port;
    protected $pdo;
    private static $instantiate;


    private function __construct()
    {
        $this->loadAttributes();
        try {
            $dsn = "mysql:dbname={$this->dataBase}; host={$this->server}; port={$this->port}";
            $this->pdo = new PDO($dsn, $this->user, $this->password);

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

    public static function getConnectionInstance(): IConexion
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

    public function getRecord(string $query, array $parameters = null): ?array
    {
        $prepareStament = $this->pdo->prepare($query);

        if ($prepareStament->execute($parameters)) {
            $records = $prepareStament->fetchAll(PDO::FETCH_ASSOC);
            return $this->converterUTF8($records);
        } else return null;
    }

    public function nonQuery(string $query, array $parameters = null): int
    {
        $prepareStament = $this->pdo->prepare($query);
        $prepareStament->execute($parameters);
        return intval($prepareStament->rowCount());
    }

    public function nonQueryID(string $query, array $parameters = null): int
    {
        try {
                $prepareStament = $this->pdo->prepare($query);
                $prepareStament->execute($parameters);
                $prepareStament->closeCursor();

                $r_idpaciente = $this->pdo->query("SELECT @id AS id");
                $id = $r_idpaciente->fetchColumn();

                return $id;

        } catch (Exception $exception) {
            echo "error en Modelos.Conexion.nonQueryID::{$exception->getMessage()}";
        }
    }

    private function converterUTF8(array $records):array
    {
        array_walk_recursive($records,function(&$item,$eky){
            if (! (mb_detect_encoding($item,"utf-8",true)) ) {
                $item = utf8_encode($item);
            }
        });
        return $records;
    }

    protected function encrypt(string $chain){
        return md5($chain);
    }
}
