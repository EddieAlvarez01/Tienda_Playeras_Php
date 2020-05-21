<?php

class UsuarioController{

    public function index(){
        echo "Controlador Usuarios accion index";
    }

    public function register(){

        //RENDERIZAR VISTA
        require_once 'views/user/register.php';
    }

    public function saveUser(){
        if(isset($_POST)){
            var_dump($_POST);
        }
    }

}