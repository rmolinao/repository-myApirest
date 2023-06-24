<?php

use Modelos\Authentication;

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

class App
{

    public static function main():void
    {
        header("Content-type: application/json");

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $authentication = new Authentication();
            $bodyRaw = file_get_contents("php://input");
            print $authentication->login($bodyRaw);
        }
    }

}
App::main();