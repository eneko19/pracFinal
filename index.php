<?php

  require_once("db/db.php");
  require_once("controllers/products_controller.php");
  require_once("controllers/categories_controller.php");
  require_once("controllers/coches_controller.php");
  require_once("controllers/login_controller.php");

  session_start();
  if (isset($_GET['controller']) && isset($_GET['action']) ) {

      if ($_GET['controller'] == "products") {

           if ($_GET['action'] == "view") {
             $controller = new products_controller();
             $controller->view();
           }

           if ($_GET['action'] == "viewPage") {
             $id = $_GET['id'];
             $controller = new products_controller();
             $product = $controller->viewPage($id);
             $controller->viewProduct($product);
            // echo "<pre>".print_r($product, 1)."</pre>"; die;
           }
           if ($_GET['action'] == "addView") {
             $controller = new products_controller();
             $controller->addView();
           }
           if ($_GET['action'] == "insert") {
             $controller = new products_controller();
             $controller->insert();
           }
      }
      if ($_GET['controller'] == "categories") {
            $controllerP = new products_controller();

          if ($_GET['action'] == "insert") {
            $controller = new categories_controller();
            $controller->insert();
            $controllerP->view();
          }
          if ($_GET['action'] == "add") {
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
              echo("error");
          }
        }

        if ($_GET['action'] == "register") {
          $login = new login_controller();
          $login->register();
        }

        if ($_GET['action'] == "logout") {
          $login = new login_controller();
          $login->logout();
        }

        $controller->view();

      }

  } else {
     $controller = new products_controller();
     $controller->view();
  }
?>
