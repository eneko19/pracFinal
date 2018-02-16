<?php
//Llamada al modelo
require_once("models/brand_model.php");


class brand_controller {

  /*
  ** Función que muestra la pagina de añadir categoría
  */
  function add(){
    require_once("views/categories_add.phtml");
  }

/**
 * Función que pasa todas las categorías a la vista
 */
function view(){
    $brand = new brand_model();

    $datos = $brand->get_brands();
    require_once("views/categories_add.phtml");
}

}
?>
