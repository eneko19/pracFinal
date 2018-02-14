<?php

require_once("db/db.php");
require_once("controllers/products_controller.php");
require_once("controllers/categories_controller.php");
require_once("controllers/login_controller.php");
require_once("controllers/promotion_controller.php");
require_once("controllers/cart_controller.php");

session_start();

if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
if (isset($_GET['controller']) && isset($_GET['action'])) {

    if ($_GET['controller'] == "cart") {
        $cart = new cart_controller();
        if ($_GET['action'] == "addToCart") {

             $num = !empty($_GET['numAddUnits']) ? $_GET['numAddUnits'] : 1;
            $products = [
                "id"=>$_GET['product'],
                "numAddUnits"=>$num,
                "name"=>$_GET['productName'],
                "price"=>$_GET['productPrice'],
                "image"=>$_GET['productImage'],
                "stock"=>$_GET['productStock']
                ];
            $cart->addToCart($products);
        }
        if ($_GET['action'] == "deleteFromCart") {
            $product = $_GET['product'];
            $cart->deleteFromCart($product);
        }
        header('Location: index.php');
    }


    if ($_GET['controller'] == "products") {

        if ($_GET['action'] == "view") {
            $controller = new products_controller();
            $controller->view();
        }

        if ($_GET['action'] == "viewPage") {
            $id = $_GET['id'];
            $controller = new products_controller();
            $controller->viewPage($id);
            // echo "<pre>".print_r($product, 1)."</pre>"; die;
        }
        if ($_GET['action'] == "addView") {
            $controller = new products_controller();
            $controller->addView();
        }
        if ($_GET['action'] == "insert") {
            $controller = new products_controller();
            $controller->insert();
            $controller->view();
        }
        if ($_GET['action'] == "search") {
            $valor = $_POST["buscador"];
            $controller = new products_controller();
            $controller->search($valor);
        }
        if ($_GET['action'] == "viewCat") {
            $idSubCat = $_GET['idSubcategory'];
            $controller = new products_controller();
            $controller->viewPageCat($idSubCat);
        }
    }
    if ($_GET['controller'] == "categories") {
        $controllerP = new products_controller();

        if ($_GET['action'] == "insert") {
            $controller = new categories_controller();
            $controller->insert();
            $controllerP->view();
        }
        if ($_GET['action'] == "view") {
            $controller = new categories_controller();
            $controller->view();
        }
    }

    if ($_GET['controller'] == "login") {
        $controller = new products_controller();

        if ($_GET['action'] == "view") {
            $login = new login_controller();
            $login->view();
        }

        if ($_GET['action'] == "login") {
            $login = new login_controller();
            $loged = $login->login();
            if (!$loged) {
            $logedFail = $login->loginFailed();
            }
        }

        if ($_GET['action'] == "register") {
            $login = new login_controller();
            $login->register();
        }

        if ($_GET['action'] == "logout") {
            $login = new login_controller();
            $login->logout();
            if(empty($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }
        }

        $controller->view();
    }
    if ($_GET['controller'] == "promotion") {
      $controllerP = new products_controller();

        $controller = new products_controller();

        if ($_GET['action'] == "view") {
            $promotion = new promotion_controller();
            $promotion->view();
        }
        if ($_GET['action'] == "insert") {
            $promotion = new promotion_controller();
            $promotion->insert();
            $controllerP->view();
        }

    }
} else {
    $controller = new products_controller();
    $cart = $controller->getCart();
    $controller->view();

}
?>
