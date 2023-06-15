<?php

namespace Modelos;

use Modelos\Conexion\Conexion;

class Entity extends Conexion
{
    private $name;
    public $attributelist = [];
    private $connection;

    function __construct(string $name, array $attributelist = null)
    {
        $this->connection = self::getConnectionInstance();
        $this->name = $name;

        if ($attributelist == null) {
            $registros = $this->connection->getRecord("SHOW  columns  FROM $name");
            foreach ($registros as $registro) {
                $this->attributelist[$registro["Field"]] = null;
            }
        }else{
            $this->attributelist = $attributelist;
        }
        
    }

    public function getName():string
    {
        return $this->name;
    }
}
