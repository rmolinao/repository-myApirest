<?php

use Controladores\PacienteControlador;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

$pacienteControlador = new PacienteControlador();

$pacienteControlador->answerRequestMethod();