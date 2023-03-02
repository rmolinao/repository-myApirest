<?php

use  Clases\Conexion\Conexion;

spl_autoload_register(function ($clase) {
    require_once './'.str_replace('\\','/',$clase).'.php';
});

echo "hola soy index <br>";

$obj =  Conexion::execute();