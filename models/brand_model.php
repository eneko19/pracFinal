<?php

/**
 * Description of categories_model
 *
 * @author eneko
 */
class brand_model {
  private $db;
  private $marca;

  private $id;
  private $name;

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

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

        /**
    * Extreu totes les persones de la taula
    * @return array Bidimensional de totes les persones
    */
    public function get_brands(){
        $consulta=$this->db->query("SELECT * FROM BRAND;");
        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }


}
