<?php

namespace Modelos;

use Modelos\Conexion\Conexion;
use Modelos\RestApiSpecifications;

class Authentication extends Conexion
{
    use RestApiSpecifications;

    private $connection;

    public function __construct()
    {
        $this->connection = self::getConnectionInstance();
    }

    public function login(string $json): ?string
    {
        $data = json_decode($json, true);
        if (!isset($data["usuario"]) || !isset($data["password"])) {
            return  self::status_Code_Response_400();
        } else {
            $records = $this->getUserData($data["usuario"]);
            $encryptPassword = parent::encrypt($data["password"]);
            if ($records) {
                if ($encryptPassword === $records["Password"]) {
                    if ($records["Estado"] === "Activo") {
                        $tokenGenerated = $this->insertToken($records["UsuarioId"]);
                        if ($tokenGenerated) {
                            return self::status_Code_Response_200(null,null,200,[
                                "token" => $tokenGenerated
                            ]);
                        }else{
                             return self::status_Code_Response_500();//generar un error 500
                        }
                    } 
                    else 
                        return self::status_Code_Response_200("No conten", "el usuario esta in actvo", 203);
                } else {
                    return self::status_Code_Response_200("No conten", "el passwaord no existe", 203);
                }
            } else {
                return self::status_Code_Response_200("No conten", "Se ha aceptado la solicitud, pero no existe {$data["usuario"]}", 203);
            }
        }
        return null;
    }

    public function getUserData(string $correo): ?array
    {
        $query = "SELECT UsuarioId, Password, Estado FROM usuarios WHERE Usuario = '$correo'";
        $records = $this->connection->getRecord($query);
        if (isset($records[0]["UsuarioId"]))
            return $records[0];
        else
            return null;
    }

    public function insertToken($UsuarioId): ?string
    {
        $cstrong = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $cstrong));
        $estado = "Activo";
        $fecha = date("Y-m-d H:i");
        $query = "INSERT INTO usuarios_token(UsuarioId, Token, Estado, Fecha)VALUES('$UsuarioId','$token','$estado','$fecha')";
        $registerToken = $this->connection->nonQuery($query);
        if ($registerToken) {
            return $token;
        } else {
            return null;
        }
        

    }
}
