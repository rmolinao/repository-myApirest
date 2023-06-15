<?php
namespace Modelos;

use Modelos\Entity;

final class PacienteModelo extends  Entity
{
    
    function __construct(array $attributelist = null)
    {
        parent::__construct("pacientes", $attributelist);
    }
    
}
