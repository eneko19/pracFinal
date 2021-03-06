<?php

/**
 * Description of promotion_model
 *
 * @author eneko
 */
class promotion_model {

    private $db;
    private $promotion;
    private $id;
    private $discountpercentage;
    private $startdate;
    private $enddate;
    private $product;

    public function __construct() {
        $this->db = Conectar::conexion();
    }

    /* GETTERS & SETTERS */

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDiscountPercentage() {
        return $this->discountpercentage;
    }

    public function setDiscountPercentage($discountpercentage) {
        $this->discountpercentage = $discountpercentage;
    }

    public function getStartDate() {
        return $this->startdate;
    }

    public function setStartDate($startdate) {
        $this->startdate = $startdate;
    }

    public function getEndDate() {
        return $this->enddate;
    }

    public function setEndDate($enddate) {
        $this->enddate = $enddate;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product) {
        $this->product = $product;
    }

    /**
     * Inserta una promoción a la tabla
     * @return [false]  si no ha ocurrido ningún error,
     *         [string] con el error de sql si ha ido mal
     */
    public function insertar() {

        $sql = "INSERT INTO PROMOTION (DISCOUNTPERCENTAGE,ENDDATE,PRODUCT ) VALUES ('{$this->discountpercentage}','{$this->enddate}','{$this->product}')";

        $result = $this->db->query($sql);

        if ($this->db->error)
            return "$sql<br>{$this->db->error}";
        else {
            return false;
        }
    }

    /**
     * Extrae todas las promociones de la tabla
     * @return type con todas las columnas de las promociones
     */
    public function get_carousel() {
        $consulta = $this->db->query("SELECT img.URL, pt.NAME,pt.SHORTDESCRIPTION,pn.DISCOUNTPERCENTAGE, FORMAT((pt.PRICE * (1-(pn.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL, pt.PRICE FROM PROMOTION pn join PRODUCT pt on pt.ID = pn.PRODUCT join IMAGE img on img.PRODUCT = pt.ID;");
        while ($filas = $consulta->fetch_assoc()) {
            $this->promotion[] = $filas;
        }
        return $this->promotion;
    }

}
