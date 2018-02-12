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

  public function __construct(){
      $this->db=Conectar::conexion();
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
  * Inserta un registre a la taula
  * @return [false]  si no hi ha hagut cap error,
  *         [string] amb text d'error si no ha anat bé
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
    * Extreu totes les persones de la taula
    * @return array Bidimensional de totes les persones
    */
    public function get_carousel(){
        $consulta=$this->db->query("SELECT img.URL, pt.NAME,pt.SHORTDESCRIPTION,pn.DISCOUNTPERCENTAGE, FORMAT((pt.PRICE * (1-(pn.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL, pt.PRICE FROM PROMOTION pn join PRODUCT pt on pt.ID = pn.PRODUCT join IMAGE img on img.PRODUCT = pt.ID;");
        while($filas=$consulta->fetch_assoc()){
            $this->promotion[]=$filas;
        }
        return $this->promotion;
    }


}
