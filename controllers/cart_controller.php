<?php

//Llamada al modelo
require_once("models/categories_model.php");

class cart_controller {
    /*
     * * Función que muestra la pagina de añadir producto
     */

    function addToCart($products) {
        if (empty($_SESSION['cart'][$products['id']])) {
            $products['numUnits'] = $products['numAddUnits'];
            $_SESSION['cart'][$products['id']] = $products;
        } else {
            if ($products['stock'] > $_SESSION['cart'][$products['id']]['numUnits']){
                 $_SESSION['cart'][$products['id']]['numUnits'] += $products['numAddUnits'];
            }
        }
    }
    
    function deleteFromCart($product){
        unset($_SESSION['cart'][$product]);
        
    }
    
    function view(){
        require_once("views/cart_view.phtml");
    }

}

?>
