<?php

use Modelos\Entity;
use  Modelos\Conexion\Conexion;
use Modelos\PacienteModelo;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

echo "hola soy index <br>";

$obj =   Conexion::getConnectionInstance();
// $registros = $obj->getRecord("SELECT * FROM pacientes");
$registros = $obj->getRecord("SHOW  columns  FROM citas");
$registros = $obj->getRecord("SELECT UsuarioId, Password, Estado FROM apirest.usuarios WHERE Usuario = 'usuario1@gmail.com'");

print_r("<pre>");
print_r($registros);
print_r("</pre>");


$query ="INSERT INTO `apirest`.`pacientes` (`DNI`, `Nombre`, `Direccion`, `CodigoPostal`, `Telefono`, `FechaNacimiento`, `Correo`) VALUES ('F000000007', 'Rafael Molinna', 'Calle de pruebas 7', '20007', '633281517', '1989-05-09', 'Paciente6@gmail.com')
        ";

// echo "\n".$result = $obj->nonQuery($query);
// echo "\n".$id = $obj->nonQueryID($query);

$paciente1 = new PacienteModelo();
$cita1 = new Entity("citas");

print_r("<pre>");
print_r($cita1->attributelist);
print_r("</pre>");

$paciente1->attributelist["DNI"] = "A000000001";
$paciente1->attributelist["Nombre"] = "Juan Carlos Medina";
$paciente1->attributelist["Direccion"] = "Calle de pruebas 1";
$paciente1->attributelist["CodigoPostal"] = "20001";
$paciente1->attributelist["Telefono"] = "633281515";
$paciente1->attributelist["Genero"] = "M";
$paciente1->attributelist["FechaNacimiento"] = "1989-03-02";
$paciente1->attributelist["Correo"] = "Paciente1@gmail.com";

print_r("<pre>");
print_r($paciente1->attributelist);
print_r("</pre>");