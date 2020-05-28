<?php
require_once 'models/Producto.php';

class ProductoController{

    public function index(){

        //RENDERIZAR VISTA
        require_once 'views/producto/destacados.php';
    }

    public function manageProducts(){
        Utils::isAdmin();
        $product = new Producto();
        $products = $product->getAllProducts();
        if($products === false){
            $_SESSION['error-product-db'] = 'Error en la db al traer todos los productos';
        }
        require_once 'views/producto/manage.php';
    }

    public function createProduct(){
        Utils::isAdmin();
        $categories = Utils::showCategories();
        require_once 'views/producto/create.php';
    }

    public function saveProduct(){
        Utils::isAdmin();
        if(isset($_POST)){
            $_POST['name'] = trim($_POST['name']);
            $_POST['description'] = trim($_POST['description']);
            $_POST['price'] = trim($_POST['price']);
            $_POST['offer'] = trim($_POST['offer']);
            $isValid = GUMP::is_valid($_POST, [
                'name' => 'required',
                'price' => 'required|float',
                'stock' => 'numeric'
            ], [
                'name' => ['required' => 'Debe ingresar un nombre válido'],
                'price' => ['required' => 'Debe ingresar un precio válido', 'float' => 'Debe ingresar unicamente numeros'],
                'stock' => ['numeric' => 'Unicamente se permiten numeros en el stock']
            ]);
            if($isValid === true){
                $product = new Producto();
                $product->setName($_POST['name']);
                $product->setDescription($_POST['description']);
                $product->setPrice(number_format($_POST['price'], 2));
                $product->setStock($_POST['stock']);
                $product->setOffer($_POST['offer']);
                $product->setCategory($_POST['category']);

                //GUARDAR IMAGEN
                $file = $_FILES['image'];
                $fileName = $file['name'];
                $mimetype = $file['type'];

                if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){      //VERIFICAR MINETYPE PARA QUE SOLO PUEDA SUBIR IMAGENES
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $fileName);       //SUBIR AL SERVIDOR
                    $product->setImage($fileName);
                    if($product->saveProduct()){
                        $_SESSION['save-product'] = 1;
                    }else{
                        $_SESSION['save-product'] = 0;
                    }
                }else{
                    $_SESSION['save-product'] = 0;
                }
            }else{
                $_SESSION['error-product'] = $isValid;
            }
        }
        header("Location: " . base_url . "Producto/createProduct");
    }

    public function deleteProduct(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $product = new Producto();
            $product->setId($_GET['id']);
            if($product->deleteProduct()){
                $_SESSION['delete-product'] = 1;
            }else{
                $_SESSION['delete-product'] = 0;
            }
        }
        header("Location: " . base_url . "Producto/manageProducts");
    }

    public function editProduct(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $categories = Utils::showCategories();
            $product = new Producto();
            $product->setId($_GET['id']);
        }
    }

}