<?php
namespace Cron;

use Modelos\Token;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

class ActualizarToken
{

    public static function main(): void
    {
        $token = new Token();
        $fecha = date('Y-m-d H:i');
        $result =  $token->actualizarToken($fecha);
        echo $result?'se deshabilitaron  los toquen activos en Databa base':'no se actualizo el token';
    }

}

ActualizarToken::main();
