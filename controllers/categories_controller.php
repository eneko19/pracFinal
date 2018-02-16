<?php
//Llamada al modelo
require_once("models/categories_model.php");


class categories_controller {

  /*
  ** Funció que muestra la pagina de añadir categoría
  */
  function add(){
    require_once("views/categories_add.phtml");
  }

/**
 * Función que añade categorías a la tabla
 */
function insert() {
    $categoria = new categories_model();

        $categoria->setName($_POST['nombre']);
        $categoria->setParentCategory( $_POST['parentcategory']);

        $error = $categoria->insertar();
}

/**
 * Función que muestra todos las categorías en la vista de categorías
 */
function view(){
    $categoria = new categories_model();

    $datos = $categoria->get_categories();


    require_once("views/categories_add.phtml");
}


}
?>
