<?php

namespace Modelos;

use Modelos\Conexion\Conexion;
use Modelos\RestApiSpecifications;
use PDOException;

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
        }

        $records = $this->getUserData($data["usuario"]);
        if (!$records) {
            return self::status_Code_Response_200("No conten", "Se ha aceptado la solicitud, pero no existe {$data["usuario"]}", 203);
        }

        $encryptPassword = parent::encrypt($data["password"]);
        if (!$encryptPassword === $records["Password"]) {
            return self::status_Code_Response_200("No conten", "el passwaord no existe", 203);
        }

        if (!$records["Estado"] === "Activo") {
            return self::status_Code_Response_200("No conten", "el usuario esta in actvo", 203);
        }

        $tokenGenerated = $this->insertToken($records["UsuarioId"]);
        if (!$tokenGenerated) {
            return self::status_Code_Response_500();
        }

        return self::status_Code_Response_200(null, null, 200, [
            "token" => $tokenGenerated
        ]);

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
        try {

            $cstrong = true;
            $token = bin2hex(openssl_random_pseudo_bytes(16, $cstrong));
            $estado = "Activo";
            $fecha = date("Y-m-d H:i");
            $query = "INSERT INTO usuarios_token(UsuarioId, Token, Estado, Fecha)VALUES('$UsuarioId','$token','$estado','$fecha')";
            $registerToken = $this->connection->nonQuery($query);
            return $registerToken?$token:null;

        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    //aqui se debe colocar el codigo de autenticacion
    public function validarTokent(array $atributos): bool
    {
        $validacion = true;
        if (!isset($atributos['token'])) {
            echo self::status_Code_Response_400('no hay Token','no se ha  enviado un token de autenticacion',401);
            return $validacion = false;
        }

        $records = $this->buscarTokent($atributos['token']);
        if (!$records) {
            echo self::status_Code_Response_400('token Invalido','el token es invalio o ha caducado',401);
            return $validacion = false;
        }

        //
        return $validacion;
    }

    private function buscarTokent(string $token): ?array
    {
        try {

            $query = "SELECT TokenId,UsuarioId FROM usuarios_token WHERE Token = :token";
            $records = $this->connection->getRecord($query,[':token'=>$token]);
            return $records?$records:null;
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
}
