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

     $sql = "INSERT INTO personas (nombre, edad) VALUES ('{$this->nombre}','{$this->edad}')";
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
public function delete($id) {
    $sql = "DELETE FROM personas WHERE id='$id'";

    $result = $this->db->query($sql);

    if ($this->db->error)
        return "$sql<br>{$this->db->error}";
    else {
        return false;
    }
}
/**
 * Extreu tots els cotxes de la taula ordenats per marca
 * @return array Registres ordenats per marca
 */
public function ordnombre(){
    $consulta=$this->db->query("select * from personas ORDER BY nombre");
    while($filas=$consulta->fetch_assoc()){
        $this->personas[]=$filas;
    }
    return $this->personas;
}
/**
 * Extreu tots els cotxes de la taula ordenats per marca
 * @return array Registres ordenats per marca
 */
public function ordedad(){
    $consulta=$this->db->query("select * from personas ORDER BY edad");
    while($filas=$consulta->fetch_assoc()){
        $this->personas[]=$filas;
    }
    return $this->personas;
}
}
?>
