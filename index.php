<?php

session_start();
  require_once("db/db.php");

  require_once("controllers/products_controller.php");
  require_once("controllers/coches_controller.php");
  require_once("controllers/login_controller.php");

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


      }

      if ($_GET['controller'] == "login") {

        if ($_GET['action'] == "view") {
          $controller = new login_controller();
          $controller->view();
        }

        if ($_GET['action'] == "login") {
          $controller = new login_controller();
          $controller->login();
        }

        if ($_GET['action'] == "register") {
          $controller = new login_controller();
          $controller->register();
        }

        if ($_GET['action'] == "logout") {
          $controller = new login_controller();
          $controller->logout();
        }

      }

  } else {
     $controller = new products_controller();
     $controller->view();
  }
?>
