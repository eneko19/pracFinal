<?php
//Llamada al modelo
require_once("models/promotion_model.php");


class promotion_controller {


/**
 * Inserta a la taula
 */
function insert() {
    $promotion = new promotion_model();

    $promotion->setDiscountPercentage($_POST['descuento']);
    $promotion->setEndDate( $_POST['fechaFinal']);
    $promotion->setProduct( $_POST['categoriaPadre']);

    $error = $promotion->insertar();
}

function view(){
    $product = new products_model();

    $datos = $product->get_productsToPromotion();

    require_once("views/promotion_add.phtml");
}


}
?>
