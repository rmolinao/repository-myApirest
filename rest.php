<?php

use Controladores\PacienteControlador;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

$pacienteControlador = new PacienteControlador();
$pacienteControlador->answerRequestMethod();

// 
// $atributList = [
//     "CitaId"=> 3,
//     "PacienteId"=> 3,
//     "Fecha"=>"2020-06-18",
//     "HoraInicio"=> "09:00:00",
//     "HoraFIn"=> "09:30:00",
//     "Estado"=> "Confirmada",
//     "Motivo"=> "Dolor en el cuello",
// ];


// $pacienteDao = new PacientesDaoImpl();
// print_r("<pre>");
// print_r($pacienteDao->findAll());
// print_r("</pre>");

// $paciente = new PacienteModelo(
//     [
//         "PacienteId" => 1,
//         "DNI" => "A000000001",
//         "Nombre" => "Juan Carlos Medina-put",
//         "Direccion" => "Calle de pruebas 1-put",
//         "CodigoPostal" => "20001",
//         "Telefono" => "633281515",
//         "Genero" => "M",
//         "FechaNacimiento" => "1989-03-02",
//         "Correo" => "Paciente1@gmail.com-put"
        
//     ]
//     );

// // print_r($pacienteDao->save($paciente));

// print_r("<pre>");
// print_r($pacienteDao->findById(36));
// print_r("</pre>");

// print_r($pacienteDao->deleteById(36));

// $paciente = new PacienteModelo(
//     [
//         // "PacienteId" => 1,
//         "DNI" => "A000000001",
//         "Nombre" => "Juan Carlos Medina",
//         "Direccion" => "Calle de pruebas 1",
//         "CodigoPostal" => "20001",
//         "Telefono" => "633281515",
//         "Genero" => "M",
//         "FechaNacimiento" => "1989-03-02",
//         "Correo" => "Paciente1@gmail.com"       
//     ]
// );
//     print_r("<pre>");
//     print_r($servicio->get(3));
//     print_r("</pre>");