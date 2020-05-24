<?php

class Usuario{

    private $id;
    private $role;
    private $name;
    private $surnames;
    private $email;
    private $password;
    private $image;

    //CONEXION BASE DE DATOS
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

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $this->db->real_escape_string($name);
    }

    public function getSurnames()
    {
        return $this->surnames;
    }

    public function setSurnames($surnames)
    {
        $this->surnames = $this->db->real_escape_string($surnames);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function save(){

        //SQL QUE INSERTA UN USUARIO REGISTRADO
        $sql = "INSERT INTO Usuario(rol_id, nombre, apellidos, correo, password, imagen)
                SELECT id, '{$this->getName()}', '{$this->getSurnames()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getImage()}'
                FROM Rol
                WHERE LOWER(nombre) = 'cliente'";
        $save = $this->db->query($sql);             //EJECUTA EL QUERY
        if($save){
            return true;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

}