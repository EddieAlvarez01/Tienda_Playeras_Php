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
                        'id' => $product->getId(),
                        'price' => $result->precio,
                        'unit' => 1,
                        'product' => $result
                    );
                }
            }else{
                $this->addToCart($result, $product->getId());
            }
            header('Location: ' . base_url . 'Pedido/viewCart');
        }else{
            header('Location: ' . base_url);
        }
    }

    public function viewCart(){
        Utils::isLogged();
        require_once 'views/pedido/cart.php';
    }

    //COMPROBAR QUE EXISTE EL CARRO
    public function existCart(){
        if(!isset($_SESSION['cart'])){
            return false;
        }
        return true;
    }

    //AÑADIR PRODUCTOS AL CARRITO
    public function addToCart($product, $id){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['id'] == $id){
                $_SESSION['cart'][$index]['unit']++;
                return;
            }
        }
        $_SESSION['cart'][] = array(
            'id' => $id,
            'price' => $product->precio,
            'unit' => 1,
            'product' => $product
        );
    }

}