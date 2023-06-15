<?php
namespace Controladores;

use Servicios\PacienteServicio;

class PacienteControlador extends RestController{
    public function __construct()
    {
        parent::__construct(new PacienteServicio());   
    }
}