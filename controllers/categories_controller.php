<?php
//Llamada al modelo
require_once("models/categories_model.php");


class categories_controller {

  /*
  ** Fucnion que muestra la pagina de añadir producto
  */
  function add(){
    require_once("views/categories_add.phtml");
  }

/**
 * Inserta a la taula
 */
function insert() {
    $categoria = new categoires_model();

        $categoria->setName($_POST['nombre']);
        $categoria->setParentCategory( $_POST['parentcategory']);

        $error = $producto->insertar();

}


}
?>
