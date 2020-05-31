<?php
require_once 'models/Producto.php';
require_once 'models/Pedido.php';

class PedidoController{

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

    public function order(){
        Utils::isLogged();
        require_once 'views/pedido/order.php';
    }

    public function addOrder(){
        Utils::isLogged();
        if(isset($_POST)){
            $_POST['province'] = trim($_POST['province']);
            $_POST['location'] = trim($_POST['location']);
            $_POST['address'] = trim($_POST['address']);
            $isValid = GUMP::is_valid($_POST, [
                'province' => 'required',
                'location' => 'required',
                'address' => 'required'
            ], [
                'province' => ['required' => 'Inserte una provincia'],
                'location' => ['required' => 'Inserte una ciudad o localidad'],
                'address' => ['required' => 'Inserte una dirección']
            ]);
            if($isValid === true){
                $order = new Pedido();
                $order->setUser($_SESSION['user']['id']);
                $order->setProvince($_POST['province']);
                $order->setLocation($_POST['location']);
                $order->setAddress($_POST['address']);
                $order->setCost(Utils::calculateTotal());
                $order->setState('confirm');
                if($order->saveOrder()){
                    $_SESSION['save-order'] = 1;
                }else{
                    $_SESSION['save-order'] = 0;
                }
                header('Location: ' . base_url . 'Pedido/confirmOrder&id=' . $order->getId());
            }else{
                $_SESSION['error-order'] = $isValid;
                header('Location: ' . base_url . 'Pedido/order');
                die();
            }
        }
    }

    public function confirmOrder(){
        Utils::isLogged();
        if(isset($_SESSION['save-order']) && isset($_GET['id'])){
            require_once 'views/pedido/confirm.php';
        }else{
            header('Location: ' . base_url . 'Pedido/viewCart');
        }
    }

    public function myOrders(){
        Utils::isLogged();
        $order = new Pedido();
        $order->setUser($_SESSION['user']['id']);
        $result = $order->getAllOrdersByUser();
        require_once 'views/pedido/myOrders.php';
    }

    public function orderDetail(){
        Utils::isLogged();
        if(isset($_GET['id'])){
            $order = new Pedido();
            $order->setId($_GET['id']);
            $rOrder = $order->getOrderById();
            if($rOrder){
                $rOrder = $rOrder->fetch_object();
                $result = $order->getProductsByOrder();
                if($result){
                    require_once 'views/pedido/orderDetail.php';
                    return;
                }
            }
            header('Location: ' . base_url . 'Pedido/myOrders');
        }else{
            header('Location: ' . base_url . 'Pedido/myOrders');
        }
    }

    public function orderManagement(){
        Utils::isAdmin();
        $order = new Pedido();
        $result = $order->getAllOrders();
        require_once 'views/pedido/myOrders.php';
    }

    public function changeState(){
        Utils::isAdmin();
        if(isset($_POST['state'])){
            if(isset($_GET['id'])){
                $order = new Pedido();
                $order->setId($_GET['id']);
                $order->setState($_POST['state']);
                if($order->updateStateOrder()){
                    $_SESSION['update-order'] = 1;
                }else{
                    $_SESSION['update-order'] = 0;
                }
            }
            header('Location: ' . base_url . 'Pedido/orderManagement');
        }
    }

    public function removeFromCart(){
        Utils::isLogged();
        if($_GET['id']){
            $indexDelete = 0;
            foreach($_SESSION['cart'] as $index => $item){
                if($item['id'] == $_GET['id']){
                    $indexDelete = $index;
                    break;
                }
            }
            unset($_SESSION['cart'][$indexDelete]);
            $this->hasElements();
        }
        header('Location: ' . base_url . 'Pedido/viewCart');
    }

    //FUNCION PARA VERIFICAR SI EL CARRO SE QUEDA SIN PRODUCTOS PARA ELIMINARLO
    public function hasElements(){
        if(!(count($_SESSION['cart']) > 0)){
            Utils::deleteSession('cart');
        }
    }

    public function increaseUnits(){
        Utils::isLogged();
        if(isset($_GET['index'])){
            $_SESSION['cart'][$_GET['index']]['unit']++;
        }
        header('Location: ' . base_url . 'Pedido/viewCart');
    }

    public function decreaseUnits(){
        Utils::isLogged();
        if(isset($_GET['index'])){
            if($_SESSION['cart'][$_GET['index']]['unit'] > 1){
                $_SESSION['cart'][$_GET['index']]['unit']--;
            }
        }
        header('Location: ' . base_url . 'Pedido/viewCart');
    }

}