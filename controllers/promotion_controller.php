<?php
//Llamada al modelo
require_once("models/promotion_model.php");


class promotion_controller {


/**
 * Inserta a la taula
 */
function insert() {
    $categoria = new categories_model();

        $categoria->setName($_POST['nombre']);
        $categoria->setParentCategory( $_POST['parentcategory']);

        $error = $categoria->insertar();
}

function view(){
    $promotion = new promotion_model();

    $datosCar = $promotion->get_carousel();

    require_once("views/home.phtml");
}


}
?>
