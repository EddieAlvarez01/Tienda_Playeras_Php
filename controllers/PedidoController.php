<?php
require_once 'models/Producto.php';

class PedidoController{

    public function index(){
        echo "Controlador pedidos accion index";
    }

    //AÑADE AL CARRITO DE COMPRAS
    public function addCart(){
        Utils::isLogged();      //COMPRUEBA QUE HAY UNA SESIÓN INICIADA
        if(isset($_GET['id'])){
            $product = new Producto();
            $product->setId($_GET['id']);
            $result = $product->getProductById();
            if(!$this->existCart()){
                if(is_object($result)){
                    $_SESSION['cart'][] = array(
                        'id' => $result->id,
                        'price' => $result->precio,
                        'unit' => 1,
                        'product' => $result
                    );
                }
            }
        }else{
            header('Location: ' . base_url);
        }
    }

    //COMPROBAR QUE EXISTE EL CARRO SINO CREARLO
    public function existCart(){
        if(!isset($_SESSION['cart'])){
            return false;
        }
        return true;
    }

}