<?php
 class Producto{

     private $id;
     private $category;
     private $name;
     private $description;
     private $price;
     private $stock;
     private $offer;
     private $date;
     private $image;
     private $db;

     /**
      * Producto constructor.
      */
     public function __construct()
     {
         $this->db = Database::connect();       //CONEXION DB
     }

     /**
      * @return mixed
      */
     public function getCategory()
     {
         return $this->category;
     }

     /**
      * @param mixed $category
      */
     public function setCategory($category)
     {
         $this->category = $category;
     }

     /**
      * @return mixed
      */
     public function getName()
     {
         return $this->name;
     }

     /**
      * @param mixed $name
      */
     public function setName($name)
     {
         $this->name = $name;
     }

     /**
      * @return mixed
      */
     public function getDescription()
     {
         return $this->description;
     }

     /**
      * @param mixed $description
      */
     public function setDescription($description)
     {
         $this->description = $description;
     }

     /**
      * @return mixed
      */
     public function getPrice()
     {
         return $this->price;
     }

     /**
      * @param mixed $price
      */
     public function setPrice($price)
     {
         $this->price = $price;
     }

     /**
      * @return mixed
      */
     public function getStock()
     {
         return $this->stock;
     }

     /**
      * @param mixed $stock
      */
     public function setStock($stock)
     {
         $this->stock = $stock;
     }

     /**
      * @return mixed
      */
     public function getOffer()
     {
         return $this->offer;
     }

     /**
      * @param mixed $offer
      */
     public function setOffer($offer)
     {
         $this->offer = $offer;
     }

     /**
      * @return mixed
      */
     public function getDate()
     {
         return $this->date;
     }

     /**
      * @param mixed $date
      */
     public function setDate($date)
     {
         $this->date = $date;
     }

     /**
      * @return mixed
      */
     public function getImage()
     {
         return $this->image;
     }

     /**
      * @param mixed $image
      */
     public function setImage($image)
     {
         $this->image = $image;
     }

     /**
      * @return mixed
      */
     public function getId()
     {
         return $this->id;
     }

     /**
      * @param mixed $id
      */
     public function setId($id)
     {
         $this->id = $id;
     }

     public function getAllProducts(){
         $sql = "SELECT p.id, c.nombre AS 'categoria', p.nombre, p.precio, p.stock, p.oferta, DATE_FORMAT(p.fecha, '%d/%m/%Y') AS 'fecha', p.imagen  
                 FROM Producto p
                 INNER JOIN Categoria c ON p.categoria_id = c.id";
         $result = $this->db->query($sql);
         if($result){
            return $result;
         }
         echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
         return false;
     }

     public function saveProduct(){
         $sql = "INSERT INTO Producto(categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen)
                VALUES({$this->category}, '{$this->name}', '{$this->description}', {$this->price}, {$this->stock}, '{$this->offer}', NOW(), '{$this->image}')";
         if($this->db->query($sql)){
             return true;
         }
         echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
         return false;
     }

     public function deleteProduct(){
         $sql = "DELETE FROM Producto WHERE id = {$this->id}";
         if($this->db->query($sql)){
            return true;
         }
         echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
         return false;
     }

 }