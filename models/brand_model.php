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
    
    public function get_brandsToProd(){
        $consulta=$this->db->query("SELECT * FROM BRAND;");

        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }
   /**
    * Extreu totes les persones de la taula
    * @return array Bidimensional de totes les persones
    */
    public function get_brands($idSubCat){
        $consulta=$this->db->query("SELECT distinct p.BRAND, b.NAME
          FROM PRODUCT p, BRAND b
          where p.CATEGORY = $idSubCat and p.BRAND = b.ID");

        while($filas=$consulta->fetch_assoc()){
            $this->categoria[]=$filas;
        }
        return $this->categoria;
    }


}
