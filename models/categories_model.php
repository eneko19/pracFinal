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
  * Inserta una categoría a la tabla
  * @return [false]  si no ha habido ningún error,
  *         [string] devuelve el error y la sql si no ha ido bien
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
    * Extrae todas las categorías que sean null de la tabla
    * @return array Bidimensional de todas las categorías que son null
    */
    public function get_categories(){
        $consulta=$this->db->query("SELECT * FROM CATEGORY WHERE PARENTCATEGORY IS NULL;");
        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }
    
   /**
    * Extrae todas las categorías que no sean null de la tabla
    * @return array Bidimensional de todas las categorías que no son null
    */
    public function get_categoriesToProduct(){
        $consulta=$this->db->query("SELECT * FROM CATEGORY WHERE PARENTCATEGORY IS NOT NULL;");
        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }

        return $this->categoria;
    }
    
   /**
    * Extrae todas las categorías de la tabla
    * @return array Bidimensional de todas las categorías 
    */
    public function get_all_categories(){
        $consulta=$this->db->query("SELECT * FROM CATEGORY;");
        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }


}
