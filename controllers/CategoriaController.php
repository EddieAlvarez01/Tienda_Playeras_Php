<?php
require_once 'models/Categoria.php';

class CategoriaController{

    public function index(){
        Utils::isAdmin();
        $category = new Categoria();
        $categories = $category->getAllCategories();
        if($categories === false){
            $_SESSION['error-category-db'] = 'Error en la db al cargar las categorias';
        }
        require_once 'views/categoria/index.php';
    }

    public function create(){
        Utils::isAdmin();
        require_once 'views/categoria/create.php';
    }

    public function saveCategory(){
        Utils::isAdmin();
        if(isset($_POST)){
            $_POST['name'] = trim($_POST['name']);
            $isValid = GUMP::is_valid($_POST, [
                'name' => 'required'
            ], [
                'name' => ['required' => 'Debe ingresar un nombre válido para la categoria']
            ]);
            if($isValid === true){
                $category = new Categoria();
                $category->setName($_POST['name']);
                if($category->saveCategory()){
                    $_SESSION['save-category'] = 1;
                }else{
                    $_SESSION['save-category'] = 0;
                }
            }else{
                $_SESSION['error-category'] = $isValid;
            }
        }
        header("Location: " . base_url . "Categoria/create");
    }

}