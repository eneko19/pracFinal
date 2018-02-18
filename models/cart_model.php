<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cart_model
 *
 * @author eneko
 */
class cart_model {

    private $db;
    private $cart;
    private $id;
    private $paymentInfo;
    private $status;
    private $shippingAddress;
    private $user;
    private $orderline;
    private $order;
    private $product;
    private $quantity;
    private $price;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    /** GETTERS & SETTERS * */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPaymentInfo($paymentInfo) {
        return $this->namepaymentInfo;
    }

    public function setPaymentInfo($paymentInfo) {
        $this->paymentInfo = $paymentInfo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getShippingAddress() {
        return $this->shippingAddress;
    }

    public function setShippingAddress($shippingAddress) {
        $this->shippingAddress = $shippingAddress;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getOrderLine() {
        return $this->orderline;
    }

    public function setOrderLine($orderline) {
        $this->orderline = $orderline;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product) {
        $this->product = $product;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    /** Funciones * */

    /**
     * Inserta un registro a la tabla
     * @return [false]  si no ha ocurrido ningún error,
     *         [string] de sql y el error si algo a ido mal
     */
    public function insertarOrder() {

        $sql = "INSERT INTO `order` (PAYMENTINFO,SHIPPINGADDRESS,USER)
              VALUES ('{$this->paymentInfo}','{$this->shippingAddress}','{$this->user}')";

        $result = $this->db->query($sql);

        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return $this->db->insert_id;
        }
    }

    /** Funciones * */

    /**
     * Inserta un registro a la tabla
     * @return [false]  si no ha ocurrido ningún error,
     *         [string] de sql y el error si algo a ido mal
     */
    public function insertarOrderItem() {

        $sql = "INSERT INTO `orderitem` (ORDERLINE,`ORDER`,PRODUCT,QUANTITY,PRICE)
              VALUES ({$this->orderline},{$this->order},{$this->product},{$this->quantity},{$this->price});";

        $result = $this->db->query($sql);
        //echo($sql);die;
        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return false;
        }
    }

    public function get_cartFromDB($idOrder) {

        $consulta = $this->db->query("SELECT *,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
            FROM `product` prod
            left join PROMOTION p on p.PRODUCT = prod.ID
            join `orderitem` ordIt on ordIt.PRODUCT = prod.ID
            join IMAGE img on prod.ID = img.PRODUCT
            join `order` ord on ord.ID = ordIt.ORDER
            where ord.USER = '{$_SESSION['usuario']}' and ord.ID = {$idOrder};");

        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }


        return $this->products;
    }

    public function get_lastProducts() {
        $consulta = $this->db->query("SELECT *,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
            FROM `product` prod
            left join PROMOTION p on p.PRODUCT = prod.ID
            join `orderitem` ordIt on ordIt.PRODUCT = prod.ID
            join IMAGE img on prod.ID = img.PRODUCT
            join `order` ord on ord.ID = ordIt.ORDER
            where ord.PAYMENTINFO = 'pending'");


        while ($filas = $consulta->fetch_assoc()) {
            $this->products[] = $filas;
        }


        return $this->products;
    }

    public function insertProductCart() {

        $sql = "INSERT INTO `orderitem` (ORDERLINE,`ORDER`,PRODUCT,QUANTITY,PRICE) VALUES
               ('{$this->orderline}','{$this->order}','{$this->product}','{$this->quantity}','{$this->price}');";
        //print_r($sql);die;
        $result = $this->db->query($sql);

        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return false;
        }
    }

    public function get_maxOrderItem() {
        $consulta = $this->db->query("SELECT max(ORDERLINE) FROM `orderitem`;");

        $filas = $consulta->fetch_array();
        $numProducts = $filas[0];

        return $numProducts;
    }

    public function get_lastOrderId() {
        $consulta = $this->db->query("SELECT ID FROM `order` WHERE PAYMENTINFO = 'pending' and user = {$_SESSION['usuario']};");

        $filas = $consulta->fetch_array();
        $numProducts = $filas[0];

        return $numProducts;
    }
        public function deleteOrderItem() {

        $consulta = $this->db->query("DELETE FROM `orderitem` WHERE `orderitem`.`ORDERLINE` = {$this->orderline} AND `orderitem`.`ORDER` = {$_SESSION['idOrder']};");

    }
     public function updateOrderLogOut() {

        $consulta = $this->db->query("UPDATE `order` SET PAYMENTINFO='paid' where ID = {$_SESSION['idOrder']};");

    }

}
