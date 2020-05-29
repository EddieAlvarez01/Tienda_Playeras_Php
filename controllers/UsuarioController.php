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

    //GUARDAR UN USARIO QUE SE ESTA REGISTRANDO
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

    public function login(){
        if(isset($_POST)){
            $_POST['email'] = trim($_POST['email']);

            //VALIDAR CAMPOS
            $isValid = GUMP::is_valid($_POST, [
                'email' => 'required|valid_email',
                'password' => 'required'
            ], [
                'email' => ['required' => 'Ingrese un email', 'valid_email' => 'El correo no es válido'],
                'password' => ['required' => 'Ingrese una contraseña']
            ]);
            if($isValid === true){
                $user = new Usuario();
                $user->setEmail($_POST['email']);
                $result = $user->login($_POST['password']);
                switch ($result){
                    case 1:
                        $_SESSION['login'] = 0;
                        break;
                    case 2:
                        $_SESSION['error-login'] = ['Error en la db al iniciar sesión'];
                        break;
                    default:
                        $_SESSION['user'] = $result;
                        break;
                }
            }else{
                $_SESSION['error-login'] = $isValid;
            }
        }
        header("Location: " . base_url);
    }

    public function logout(){
        Utils::deleteSession('user');
        if(isset($_SESSION['cart'])){
            Utils::deleteSession('cart');
        }
        header("Location: " . base_url);
    }

}