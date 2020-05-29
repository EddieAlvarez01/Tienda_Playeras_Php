<?php

class Utils{

    //BORRA SESIONES
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    //COMPROBAR QUE UN USUARIO ES ADMINISTRADOR
    public static function isAdmin(){
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['rol'] == 'administrador'){
                return 0;
            }
        }
        header("Location: " . base_url);
    }

    //COMPROBAR QUE UN USARIO ESTA LOGEADO
    public static function isLogged(){
        if(isset($_SESSION['user'])){
            return 0;
        }
        $_SESSION['error-logged'] = 1;
        header('Location: ' . base_url . 'Producto/index');
    }

    public static function showCategories(){
        require_once 'models/Categoria.php';
        $category = new Categoria();
        return $category->getAllCategories();
    }

}