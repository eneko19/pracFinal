<?php

//Llamada al modelo
require_once("models/categories_model.php");

class cart_controller {

/**
 * Función que añade productos al carrito
 * Si el número que añade es mayor al stock del producto, no lo añade
 * @param type $products array con todos los datos del producto
 */
    function addToCart($products) {
        if (empty($_SESSION['cart'][$products['id']])) {
            $products['numUnits'] = $products['numAddUnits'];
            $_SESSION['cart'][$products['id']] = $products;
        } else {
            if ($products['stock'] > $_SESSION['cart'][$products['id']]['numUnits']) {
                $_SESSION['cart'][$products['id']]['numUnits'] += $products['numAddUnits'];
            }
        }
    }

    /**
     * Función que borra el producto del carrito
     * @param type $product
     */
    function deleteFromCart($product) {
        unset($_SESSION['cart'][$product]);
    }

    /**
     * Función que muestra la vista del carrito
     */
    function view() {
        require_once("views/cart_view.phtml");
    }

}

?>
