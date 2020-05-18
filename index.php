<?php
require_once 'autoload.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

if(isset($_GET['controller'])){
    $nameController = $_GET['controller'] . 'Controller';              //COMPRUEBA SI EXISTE UN CONTROLADOR POR LA URL
}else{
    echo "La página que buscas no existe";
    exit();
}

if(class_exists($nameController)){
    $controller = new $nameController();            //CREACION DE NUEVA INSTANCIA EN CASO QUE EXISTA EL CONTROLADOR
    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){   //SI VIENE UNA ACCION Y EXISTE LA ACCION EN LA CLASE SE EJECUTA
        $action = $_GET['action'];
        $controller->$action();
    }else{
        echo "La página que buscas no existe";
    }
}else{
    echo "La págiona que buscas no existe";
}

require_once 'views/layout/footer.php';