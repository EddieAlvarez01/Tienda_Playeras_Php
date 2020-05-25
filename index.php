<?php
session_start();
require_once 'autoload.php';
require_once 'vendor/autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';
require_once 'config/parameters.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//MOSTRAR ERROR DE UN RECURSO INEXISTENTE
function showError(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nameController = $_GET['controller'] . 'Controller';              //COMPRUEBA SI EXISTE UN CONTROLADOR POR LA URL
}else if(!isset($_GET['action'])) {
    $nameController = controller_default;
}else{
    showError();
    exit();
}

if(class_exists($nameController)){
    $controller = new $nameController();            //CREACION DE NUEVA INSTANCIA EN CASO QUE EXISTA EL CONTROLADOR
    if(isset($_GET['action']) && $_GET['action'] != ''){
        if(method_exists($controller, $_GET['action'])){        //SI EXISTE EL METODO EN EL CONTROLADOR
            $action = $_GET['action'];
            $controller->$action();
        }else{
            showError();
        }
    }else{
        $action = action_default;
        $controller->$action();
    }
}else{
    showError();
}

require_once 'views/layout/footer.php';