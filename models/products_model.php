<?php
class products_model{

private $db;
private $products;

private $id;
private $name;
private $stock;
private $price;
private $sponsored;
private $shortdescription;
private $longdescription;
private $brand;
private $category;

public function __construct(){
    $this->db=Conectar::conexion();
    $this->products=array();
}

/* GETTERS & SETTERS */

public function getId() {
  return $this->id;
}

public function setId($id) {
  $this->id = $id;
}

public function getName() {
  return $this->name;
}

public function setName($name) {
  $this->name = $name;
}

public function getStock() {
  return $this->stock;
}

public function setStock($stock) {
  $this->stock = $stock;
}
public function getPrice() {
  return $this->price;
}

public function setPrice($price) {
  $this->price = $price;
}
public function getSponsored() {
  return $this->sponsored;
}

public function setSponsored($sponsored) {
  $this->sponsored = $sponsored;
}
public function getShortDescription() {
  return $this->shortdescription;
}

public function setShortDescription($shortdescription) {
  $this->shortdescription = $shortdescription;
}
public function getLongDesc() {
  return $this->longdescription;
}

public function setLongDescription($longdescription) {
  $this->longdescription = $longdescription;
}
public function getBrand() {
  return $this->brand;
}

public function setBrand($brand) {
  $this->brand = $brand;
}
public function getCategory() {
  return $this->category;
}

public function setCategory($category) {
  $this->category = $category;
}


/**
* Extreu totes les persones de la taula
* @return array Bidimensional de totes les persones
*/
public function get_products(){
    $consulta=$this->db->query("SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
    FROM PRODUCT prod
    join IMAGE img on prod.ID = img.PRODUCT
    left join PROMOTION p on p.PRODUCT = prod.ID
    WHERE SPONSORED = 'y';");

    while($filas=$consulta->fetch_assoc()){
        $this->products[]=$filas;
    }


    return $this->products;
}
public function get_productsToPromotion(){
    $consulta=$this->db->query("SELECT * FROM PRODUCT;");

    while($filas=$consulta->fetch_assoc()){
        $this->products[]=$filas;
    }


    return $this->products;
}


/**
* Inserta un registre a la taula
* @return [false]  si no hi ha hagut cap error,
*         [string] amb text d'error si no ha anat bé
*/
public function insertar() {

     $sql = "INSERT INTO PRODUCT (NAME, SHORTDESCRIPTION, LONGDESCRIPTION, STOCK, PRICE, SPONSORED, BRAND, CATEGORY)
              VALUES ('{$this->name}','{$this->shortdescription}','{$this->longdescription}','{$this->stock}','{$this->price}',
              '{$this->sponsored}','{$this->brand}','{$this->category}')";

     $result = $this->db->query($sql);

     if ($this->db->error)
         return "$sql<br>{$this->db->error}";
     else {
         return false;
     }
}


/**
* Esborra un registre de la taula
* @param  int $id Identificador del registre
* @return [false]  si no hi ha hagut cap error,
*         [string] amb text d'error si no ha anat bé
*/
public function viewPage($id) {
    $sql = "SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
    FROM PRODUCT prod
    join IMAGE img on prod.ID = img.PRODUCT
    left join PROMOTION p on p.PRODUCT = prod.ID
    WHERE prod.ID=$id";

    $result = $this->db->query($sql);

    $fila = $result->fetch_assoc();
    return $fila;

     //echo "<pre>".print_r($fila, 1)."</pre>"; die;
}

/**
* Muestra los productos segun la categoria
* @param  int $id Identificador del registre
* @return [false]  si no hi ha hagut cap error,
*         [string] amb text d'error si no ha anat bé
*/
public function viewPageCat($idSubCat) {

      $consulta=$this->db->query("SELECT *,prod.ID, img.URL,FORMAT((prod.PRICE * (1-(p.DISCOUNTPERCENTAGE/100))),2) AS PRECIOFINAL
        FROM PRODUCT prod
        join IMAGE img on prod.ID = img.PRODUCT
        left join PROMOTION p on p.PRODUCT = prod.ID
        WHERE CATEGORY='$idSubCat';");

      while($filas=$consulta->fetch_assoc()){
          $this->products[]=$filas;
      }
      return $this->products;
}

  public function search($valor){

    $consulta=$this->db->query("SELECT *, img.URL FROM PRODUCT prod
      join IMAGE img on prod.ID = img.PRODUCT WHERE SHORTDESCRIPTION like '%$valor%';");

    while($filas=$consulta->fetch_assoc()){
        $this->products[]=$filas;
    }
    return $this->products;


  }
}
?>
