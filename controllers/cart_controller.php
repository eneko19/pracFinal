<?php

//Llamada al modelo
require_once("models/categories_model.php");
require_once("models/products_model.php");
require_once("models/cart_model.php");

class cart_controller {

    /**
     * Función que añade productos al carrito
     * Si el número que añade es mayor al stock del producto, no lo añade
     * @param type $products array con todos los datos del producto
     */
    function addToCart($products) {


        if (!empty($_SESSION['usuario'])) {
            $cart = new cart_model();


            $idOrder = $cart->get_lastOrderId();
            $_SESSION['idOrder'] = $idOrder;


            $num = !empty($_GET['numAddUnits']) ? $_GET['numAddUnits'] : 1;
            $order = $cart->get_maxOrderItem();

            $cart->setOrderLine($order + 1);
            $cart->setOrder($idOrder);
            $cart->setProduct($_GET['product']);
            $cart->setQuantity($num);
            $cart->setPrice($_GET['productPrice']);

            $cart->insertProductCart();
        } else {
            if (empty($_SESSION['cart'][$products['id']])) {
                $products['numUnits'] = $products['numAddUnits'];
                $_SESSION['cart'][$products['id']] = $products;
            } else {
                if ($products['stock'] > $_SESSION['cart'][$products['id']]['numUnits']) {
                    $_SESSION['cart'][$products['id']]['numUnits'] += $products['numAddUnits'];
                }
            }
        }
    }

    function updateOrderLogOut($id) {
        $cart = new cart_model();

        $cart->setPaymentInfo("rejected");
    }

    function insertarCartBD() {
        if (!empty($_SESSION['usuario'])) {
            if (!empty($_SESSION['cart'])) {
                $cart = new cart_model();

                $cart->setPaymentInfo("pending");
                $cart->setShippingAddress("");
                $cart->setUser($_SESSION['usuario']);

                $idOrder = $cart->insertarOrder();
                $_SESSION['idOrder'] = $idOrder;


                $cont = 1;
                foreach ($_SESSION['cart'] as $orderitem) {
                    $cart->setOrderLine($cont);
                    $cart->setOrder($idOrder);
                    $cart->setProduct($orderitem['id']);
                    $cart->setQuantity($orderitem['numAddUnits']);
                    $cart->setPrice($orderitem['price']);

                    $cart->insertarOrderItem();
                    $cont++;
                }
            }
        }
    }

    function get_cartFromDB($idOrder) {
        $cart = new cart_model();

        $products = $cart->get_cartFromDB($idOrder);
    }

    /**
     * Función que borra el producto del carrito
     * @param type $product
     */
    function deleteFromCart($product) {
         if (!empty($_SESSION['usuario'])) {
             $cart = new cart_model();
             $cart->setOrderLine($product);
             $cart->deleteOrderItem();
         }else{
            unset($_SESSION['cart'][$product]);
         }
        
    }

    /**
     * Función que muestra la vista del carrito
     */
    function view() {
        $cart = new cart_model();
        if (!empty($_SESSION['usuario'])) {
            if (empty($_SESSION['cart'])) {
                $idOrder = $_SESSION['idOrder'];
                $products = $cart->get_cartFromDB($idOrder);
            }
        }
        require_once("views/cart_view.phtml");
    }

    function deleteCart() {
        unset($_SESSION['cart']);
    }
        function updateFromCart() {
         if (!empty($_SESSION['usuario'])) {
             $cart = new cart_model();
             $cart->updateOrderLogOut();

         }
        
    }

}

?>
