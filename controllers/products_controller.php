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
    $persona=new personas_model();

    if (isset($_POST['insert'])) {
        $persona->setNombre( $_POST['nombre'] );
        $persona->setEdad( $_POST['edad'] );

        $error = $persona->insertar();

        if (!$error) {
            header( "Location: index.php");
        }
        else {
            echo $error;
        }
    }
}

/**
 * Mostra els cotxes ordenats per marca
 * @return No
 */
  function ordnombre() {
    $persona=new personas_model();

    //Uso metodo del modelo de coches
    $datos=$persona->ordnombre();

    //Llamado a la vista: mostrar la pantalla
    require_once("views/personas_view.phtml");
  }
  /**
   * Mostra els cotxes ordenats per marca
   * @return No
   */
    function ordedad() {
      $persona=new personas_model();

      //Uso metodo del modelo de coches
      $datos=$persona->ordedad();

      //Llamado a la vista: mostrar la pantalla
      require_once("views/personas_view.phtml");
    }

}
?>
