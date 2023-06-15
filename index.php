<?php

spl_autoload_register(function ($clase) {
    require_once './' . str_replace('\\', '/', $clase) . '.php';
});

//escribir codigo desde aqui
echo "page index";