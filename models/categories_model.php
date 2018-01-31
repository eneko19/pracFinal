<?php

/**
 * Description of categories_model
 *
 * @author eneko
 */
class categories_model {
  private $db;
  private $categoria;

  private $id;
  private $name;
  private $parentcategory;

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

  public function getParentCategory() {
    return $this->parentcategory;
  }

  public function setParentCategory($parentcategory) {
    $this->parentcategory = $parentcategory;
  }



  /**
  * Inserta un registre a la taula
  * @return [false]  si no hi ha hagut cap error,
  *         [string] amb text d'error si no ha anat bé
  */
  public function insertar() {

       $sql = "INSERT INTO PRODUCT (NAME, PARENTCATEGORY ) VALUES ('{$this->name}','{$this->parentcategory}')";

       $result = $this->db->query($sql);

       if ($this->db->error)
           return "$sql<br>{$this->db->error}";
       else {
           return false;
       }
    }
}
