<?php
//Llamada al modelo
require_once("models/products_model.php");


class products_controller {

/**
 * Muestra pantalla 'add'
 * @return No
 */
function add() {
  require_once("views/products_add.phtml");
}


/**
 * Mostra llistat
 * @return No
 */
function view() {
  $producto = new products_model();

  //Uso metodo del modelo de personas
  $datos=$producto->get_products();

  //Llamado a la vista: mostrar la pantalla
  require_once("views/home.phtml");
}


/**
 *
 * @return
 */
function viewPage($id) {
    $producto = new products_model();

    $id = $_GET['id'];

    $producto = $producto->viewPage($id);

    return $producto;

}

// Muestra la vista de producto
function viewProduct($product){
  require_once("views/products_view.phtml");
}

/**
 * Inserta a la taula
 * @return No
 */
function insert() {
    $producto = new products_model();

        $producto->setName($_POST['nombre']);
        $producto->setShortDescription( $_POST['descCorta']);
        $producto->setLongDescription( $_POST['descLarga']);
        $producto->setSponsored( $_POST['sponsor']);
        $producto->setPrice( $_POST['precio']);
        $producto->setStock( $_POST['stock']);
        $producto->setBrand( $_POST['marca']);
        $producto->setCategory( $_POST['categoria']);

        $error = $producto->insertar();

}

    /*
    ** Fucnion que muestra la pagina de añadir producto
    */
    function addView(){

      $categoria = new categories_model();

      $datos = $categoria->get_categories();

      require_once("views/products_add.phtml");
    }

}
?>
