<?php
require_once 'models/Producto.php';

class ProductoController{

    public function index(){
        $product = new Producto();
        $result = $product->getRandomProduct(6);

        //RENDERIZAR VISTA
        require_once 'views/producto/index.php';
    }

    public function listByCategory(){
        if(isset($_GET['id'])){
            $product = new Producto();
            $result = $product->getProductByCategory($_GET['id']);
            require_once 'views/producto/index.php';
        }else{
            header("Location: " . base_url . 'Producto/index');
        }
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

                if(!isset($_GET['id'])){
                    if(isset($_FILES['image'])){

                        //GUARDAR IMAGEN
                        $file = $_FILES['image'];
                        if($this->checkExtension($file['type'])){   //VERIFICAR EXTENSION
                            $this->checkDirUploads();       //VERIFICAR CARPETA UPLOADS
                            $this->uploadImage($file);       //SUBIR AL SERVIDOR
                            $product->setImage($file['name']);
                            if($product->saveProduct()){
                                $_SESSION['save-product'] = 1;
                            }else{
                                $_SESSION['save-product'] = 0;
                            }
                        }else{
                            $_SESSION['save-product'] = 0;
                        }
                    }else{
                        $_SESSION['save-product'] = 0;
                    }
                }else{
                    $product->setId($_GET['id']);
                    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
                        $file = $_FILES['image'];
                        if($this->checkExtension($file['type'])){
                            $this->checkDirUploads();
                            $this->uploadImage($file);
                            $product->setImage($file['name']);
                            if($_GET['img'] != ""){
                                unlink('uploads/images/' . $_GET['img']) or die("No se pudo eliminar la imagen " . $_GET['img']);
                            }
                        }else{
                            $_SESSION['edit-product'] = 0;
                        }
                    }else{
                        $product->setImage($_GET['img']);
                    }
                    if(!isset($_SESSION['edit-product'])){
                        if($product->editProduct()){
                            $_SESSION['edit-product'] = 1;
                        }else{
                            $_SESSION['edit-product'] = 0;
                        }
                    }
                }
            }else{
                $_SESSION['error-product'] = $isValid;
                if(isset($_GET['id'])){
                    header("Location: " . base_url . "Producto/editProduct&id=" . $_GET['id']);
                    die();
                }
            }
        }
        if(!isset($_GET['id'])){
            header("Location: " . base_url . "Producto/createProduct");
        }else{
            header("Location: " . base_url . "Producto/manageProducts");
        }
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
            $pro = $product->getProductById();         // TRAE UN FALSE UN EL PRODUCTO COMO OBJETO
            if($pro === false){
                $_SESSION['error-edit'] = 'Error al editar el producto';
            }
            require_once 'views/producto/create.php';
        }
    }

    public function productDetail(){
        if(isset($_GET['id'])){
            $product = new Producto();
            $product->setId($_GET['id']);
            $result = $product->getProductById();
            if($result === false){
                $_SESSION['error-detail-db'] = 1;
            }
            require_once 'views/producto/detail.php';
        }else{
            header('Location: ' . base_url . 'Producto/index');
        }
    }

    //VERIFICAR MIMETYPE PARA VALIDAR EXTENSION
    public function checkExtension($mimetype){
        if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {      //VERIFICAR MINETYPE PARA QUE SOLO PUEDA SUBIR IMAGENES
            return true;
        }
        return false;
    }

    //VERIFICAR QUE EXISTE EL DIRECTORIO DE UPLOADS SINO CREARLO
    public function checkDirUploads(){
        if(!is_dir('uploads/images')){
            mkdir('uploads/images', 0777, true);
        }
    }

    //SUBIR EL ARCHIVO AL SERVER(IMAGEN)
    public function uploadImage($file){
        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $file['name']);
    }

}