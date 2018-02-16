<?php
//Llamada al modelo
require_once("models/promotion_model.php");


class promotion_controller {


/**
 * Inserta una promoción en la tabla
 */
function insert() {
    $promotion = new promotion_model();

    $promotion->setDiscountPercentage($_POST['descuento']);
    $promotion->setEndDate( $_POST['fechaFinal']);
    $promotion->setProduct( $_POST['categoriaPadre']);

    $error = $promotion->insertar();
}

/**
 * Función que muestra todos los productos y los envia a la vista de promotion
 */
function view(){
    $product = new products_model();

    $datos = $product->get_productsToPromotion();

    require_once("views/promotion_add.phtml");
}


}
?>
