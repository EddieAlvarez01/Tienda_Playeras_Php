<?php

class Categoria{

    private $id;
    private $name;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAllCategories(){
        $sql = "SELECT * FROM Categoria";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function saveCategory(){
        $sql = "INSERT INTO Categoria(nombre)
                VALUES('{$this->name}')";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

}