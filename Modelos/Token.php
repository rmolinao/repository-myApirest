<?php
namespace Modelos;

use Exception;
use Modelos\Conexion\Conexion;

/**
 *
 */
class Token extends Conexion
{

    public function __construct()
    {

    }
    public function actualizarToken($fecha):bool
    {
        try {

            $sql = "UPDATE apirest.usuarios_token SET Estado = 'Inactivo' WHERE Fecha < DATE('$fecha')AND  Estado = 'Activo'";
            $numFilasAfectadas = (parent::getConnectionInstance())->nonQuery($sql);
            return ($numFilasAfectadas > 0);

        } catch (Exception $excep) {
            echo "Exceptio Modelos/Token ::".$excep->getMessage();
        }
    }
}