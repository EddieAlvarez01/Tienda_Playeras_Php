<?php
require_once 'models/Usuario.php';

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
            $_POST['name'] = trim($_POST['name']);
            $_POST['surnames'] = trim($_POST['surnames']);
            $_POST['email'] = trim($_POST['email']);

            //VALIDAR CAMPOS
            $isVallid = GUMP::is_valid($_POST, [
                'name' => 'required|valid_name',
                'surnames' => 'required|valid_name',
                'email' => 'required|valid_email',
                'password' => 'required'
            ],[
                'name' => ['required' => 'Ingrese un nombre', 'valid_name' => 'El nombre no es válido solo debe tener letras'],
                'surnames' => ['required' => 'Ingrese un apellido', 'valid_name' => 'Los apellidos no son válidos'],
                'email' => ['required' => 'Ingrese un correo electronico', 'valid_email' => 'Inserte un correo valido'],
                'password' => ['required' => 'Ingrese una contraseña']
            ]);
            if($isVallid === true){
                $user = new Usuario();
                $user->setName($_POST['name']);
                $user->setSurnames($_POST['surnames']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                if($user->save()){      //SI EL QUERY ES EXITOSO
                    $_SESSION['register'] = 1;
                }else{
                    $_SESSION['register'] = 0;
                }
            }else{
                $_SESSION['error-user'] = $isVallid;
                $_SESSION['register'] = 0;
            }
        }else{
            $_SESSION['register'] = 0;
        }
        header("Location: " . base_url . 'Usuario/register');
    }

}