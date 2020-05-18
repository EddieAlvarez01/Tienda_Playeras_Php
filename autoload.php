<?php

/*CARGA LOS CONTROLADORES*/
function controllersAutoload($classname){
    include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllersAutoload');
