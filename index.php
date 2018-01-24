<?php
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

           if ($_GET['action'] == "add") {
             $controller = new personas_controller();
             $controller->add();
           }

           if ($_GET['action'] == "insert") {
             $controller = new personas_controller();
             $controller->insert();
           }

           if ($_GET['action'] == "delete") {
             $controller = new personas_controller();
             $controller->delete();
           }
           if ($_GET['action'] == "ordnombre") {
             $controller = new personas_controller();
             $controller->ordnombre();
           }
           if ($_GET['action'] == "ordedad") {
             $controller = new personas_controller();
             $controller->ordedad();
           }

      }
      if ($_GET['controller'] == "coches") {

        if ($_GET['action'] == "view") {
          $controller = new coches_controller();
          $controller->view();
        }

        if ($_GET['action'] == "add") {
          $controller = new coches_controller();
          $controller->add();
        }

        if ($_GET['action'] == "insert") {
          $controller = new coches_controller();
          $controller->insert();
        }

        if ($_GET['action'] == "delete") {
          $controller = new coches_controller();
          $controller->delete();
        }

        if ($_GET['action'] == "ordmarca") {
          $controller = new coches_controller();
          $controller->ordmarca();
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
