<?php

use Modelos\PacienteModelo;
use DAO\Implementaciones\PacientesDaoImpl;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

header("Content-type: application/json");

function requestMethod(): void
{
    $request = $_SERVER["REQUEST_METHOD"];

    if ($request === "GET") {

        if (isset($_GET["id"]) && isset($_GET["parametro"])) {
            $data = [];
            $data["id"] = $_GET["id"];
            $data["parametro"] = $_GET["parametro"];
            echo json_encode($data);
        } else {
            $atributos = array(
                "DNI" => "A000000001",
                "Nombre" => "Juan Carlos Medina",
                "Direccion" => "Calle de pruebas 1",
                "CodigoPostal" => "20001",
                "Telefono" => "633281515",
                "Genero" => "M",
                "FechaNacimiento" => "1989-03-02",
                "Correo" => "Paciente1@gmail.com"
            );

            $paciente1 = new PacienteModelo($atributos);
            echo json_encode($paciente1->attributelist);
        }

        return;
    }

    if ($request === "POST") {
        $bodyRaw = file_get_contents("php://input"); //caputo el json del body raw de la solicitud
        $atributos = json_decode($bodyRaw, true); //convierto en array asociativo
        $paciente = new PacienteModelo($atributos);
        $pacientesDaoImpl = new PacientesDaoImpl();
        echo $pacientesDaoImpl->save($paciente);
        //llamo al metodo que realizasara la Insercion en la base de satos
        return;
    }

    if ($request === "PUT") {
        if (isset($_GET["id"]) && isset($_GET["parametro"])) {
            $data = [];
            $data["id"] = $_GET["id"];
            $data["parametro"] = $_GET["parametro"];
            echo json_encode($data);
        }
    }
}

requestMethod();

$atributos = array(
    "DNI" => "A0000000030",
    "Nombre" => "Sebaztian Martinez",
    "Direccion" => "Calle de pruebas 30",
    "CodigoPostal" => "20001",
    "Telefono" => "633281515",
    "Genero" => "M",
    "FechaNacimiento" => "1989/03/02",
    "Correo" => "Paciente30@gmail.com"
);

$paciente = new PacienteModelo($atributos);
$pacientesDaoImpl = new PacientesDaoImpl();


echo $pacientesDaoImpl->save($paciente);

/* Bodyraw = {

    "DNI": "A0000000023",
    "Nombre": "Carlos Medina",
    "Direccion": "Calle de pruebas 24",
    "CodigoPostal": "20001",
    "Telefono": "633281515",
    "Genero": "M",
    "FechaNacimiento": "1989-03-02",
    "Correo": "Paciente24@gmail.com"

}*/