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
  * Inserta un registre a la taula
  * @return [false]  si no hi ha hagut cap error,
  *         [string] amb text d'error si no ha anat bé
  */
  public function insertar() {


      if ($this->parentcategory == "NULL") {
        $sql = "INSERT INTO CATEGORY (NAME ) VALUES ('{$this->name}')";

      }else {
       $sql = "INSERT INTO CATEGORY (NAME, PARENTCATEGORY ) VALUES ('{$this->name}','{$this->parentcategory}')";
      }
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
    public function get_brands(){
        $consulta=$this->db->query("SELECT * FROM BRAND;");
        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }


}
