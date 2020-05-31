<?php

class Pedido{

    private $id;
    private $user;
    private $province;
    private $location;
    private $address;
    private $cost;
    private $state;
    private $date;
    private $db;

    /**
     * Pedido constructor.
     */
    public function __construct()
    {
        $this->db = Database::connect();
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
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

    public function saveOrder(){
        $sql = "INSERT INTO Pedido(usuario_id, provincia, localidad, direccion, coste, estado, fecha)
                VALUES({$this->user}, '{$this->province}', '{$this->location}', '{$this->address}', {$this->cost}, '{$this->state}', NOW())";
        if($this->db->query($sql)){
            $sql = "SELECT LAST_INSERT_ID() AS 'id';";
            $result = $this->db->query($sql);
            if($result){
                $result = $result->fetch_object();
                $this->id = $result->id;
                foreach($_SESSION['cart'] as $item){
                    if(!$this->saveOrderDetails($this->id, $item['id'], $item['unit'])){
                        return false;
                    }
                }
                return true;
            }
            echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
            return false;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function saveOrderDetails($id, $idProduct, $quantity){
        $sql = "INSERT INTO Detalle_Pedido(pedido_id, producto_id, cantidad)
                VALUES($id, $idProduct, $quantity)";
        if($this->db->query($sql)){
            return true;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function getAllOrdersByUser(){
        $sql = "SELECT id, provincia, localidad, direccion, coste, estado, DATE_FORMAT(fecha, '%d/%m/%Y') AS 'fecha'
                FROM Pedido
                WHERE usuario_id = {$this->user}";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function getOrderById(){
        $sql = "SELECT coste, provincia, localidad, direccion, estado
                FROM Pedido
                WHERE id = {$this->id}";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function getProductsByOrder(){
        $sql = "SELECT p.nombre, p.precio, dp.cantidad
                FROM Detalle_Pedido dp
                INNER JOIN Producto p ON dp.producto_id = p.id
                WHERE pedido_id = {$this->id}";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function getAllOrders(){
        $sql = "SELECT id, provincia, localidad, direccion, coste, estado, DATE_FORMAT(fecha, '%d/%m/%Y') AS 'fecha'
                FROM Pedido";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

    public function updateStateOrder(){
        $sql = "UPDATE Pedido
                SET estado = '{$this->state}'
                WHERE id = {$this->id}";
        if($this->db->query($sql)){
            return true;
        }
        echo("<script>console.log('PHP: " . $this->db->error . "');</script>");
        return false;
    }

}
