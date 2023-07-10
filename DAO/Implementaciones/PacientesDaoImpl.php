<?php

namespace DAO\Implementaciones;

use Modelos\Entity;
use Modelos\Conexion\Conexion;
use DAO\Interfaces\IPacientesDao;

class PacientesDaoImpl extends Conexion  implements IPacientesDao
{
    private $conexion;
    function __construct()
    {
        $this->conexion = self::getConnectionInstance();
    }
    public function findAll($page = 1): array
    {
        $start = 0;
        $amount = 100;
        if ($page > 1) {
            $start = ($amount * ($page - 1)) + 1;
            $amount = $amount * $page;
        }
        $query ="SELECT * FROM apirest.pacientes limit $start, $amount";
        return $this->conexion->getRecord($query);
    }
    public function save(Entity $entity):int
    {
        if (isset($entity->attributelist["PacienteId"])) {
            return $this->update($entity);
        } else {
            return  $this->insert($entity);
        }
    }
    public function findById(int $id): ?array
    {
        $query ="SELECT * FROM `apirest`.`pacientes` WHERE (`PacienteId` = '$id')";
        $record = $this->conexion->getRecord($query);
        if (!empty($record)) {
            return $record[0];
        }
        return [];

    }
    public function deleteById(int $id): int
    {
        $query = "DELETE FROM `apirest`.`pacientes` WHERE (`PacienteId` = '$id')";
        return $this->conexion->nonQuery($query);

    }

    private  function update(Entity $entity) :int
    {
        $query = "UPDATE `apirest`.`{$entity->getName()}` SET `DNI` = '{$entity->attributelist["DNI"]}', `Nombre` = '{$entity->attributelist["Nombre"]}', `Direccion` = '{$entity->attributelist["Direccion"]}', `CodigoPostal` = '{$entity->attributelist["CodigoPostal"]}', `Telefono` = '{$entity->attributelist["Telefono"]}', `Genero` = '{$entity->attributelist["Genero"]}', `FechaNacimiento` = '{$entity->attributelist["FechaNacimiento"]}', `Correo` = '{$entity->attributelist["Correo"]}' WHERE (`PacienteId` = {$entity->attributelist["PacienteId"]})";

        return $this->conexion->nonQuery($query);
    }
    private function insert(Entity $entity) :int {
        $sqlparamertos = [
            "dni" => $entity->attributelist["DNI"],
            "nombre" => $entity->attributelist["Nombre"],
            "direccion" => $entity->attributelist["Direccion"],
            "codigoPostal" => $entity->attributelist["CodigoPostal"],
            "telefono" => $entity->attributelist["Telefono"],
            "genero" => isset($entity->attributelist["Genero"]) ? $entity->attributelist["Genero"] : '',
            "fechaNacimiento" => $entity->attributelist["FechaNacimiento"],
            "correo" => $entity->attributelist["Correo"],
            "imagen" =>$entity->attributelist["Imagen"]
        ];
        $query ="call insert_pacientes( :dni,
                                        :nombre,
                                        :direccion,
                                        :codigoPostal,
                                        :telefono,
                                        :genero,
                                        :fechaNacimiento,
                                        :correo,
                                        :imagen
                                        ,@id
                                        )";

        return $this->conexion->nonQueryID($query,$sqlparamertos);

    }
}