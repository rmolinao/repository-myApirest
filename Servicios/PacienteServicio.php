<?php
namespace Servicios;

use Servicios\Servicio;
use DAO\Implementaciones\PacientesDaoImpl;

class PacienteServicio extends Servicio
{
    function __construct()
    {
        parent::__construct(new PacientesDaoImpl(),"pacientes");
    }
}