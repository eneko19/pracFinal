<?php
//Llamada al modelo
require_once("models/brand_model.php");


class brand_controller {

  /*
  ** Fucnion que muestra la pagina de añadir producto
  */
  function add(){
    require_once("views/categories_add.phtml");
  }


function view(){
    $brand = new brand_model();

    $datos = $brand->get_brands();


    require_once("views/categories_add.phtml");
}


}
?>
