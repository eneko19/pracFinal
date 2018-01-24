<?php
//Llamada al modelo
require_once("models/login_model.php");


class login_controller {

/**
 * Mostra llistat
 * @return No
 */
  function view() {
    //Llamado a la vista: mostrar la pantalla
    require_once("views/login_view.phtml");
  }


/**
 * Inicia sesion de un usuario
 */
  function login() {
      $usuario = new login_model();

      $usuario->setUsername($_POST['user']);
      $usuario->setPassword($_POST['password']);

      $ok = $usuario->consultar_usuario();

          if ($ok) {
            session_start();
            $_SESSION['usuario'] = $_POST['USERNAME'];
            header( "Location: index.php?controller=products&action=view");
          }
          else {
              header( "Location: index.php?controller=products&action=view");
          }
      }

      /**
       * Registra un usuario
       */
        function register() {


            $usuario = new login_model();

            $usuario->setUserName ($_POST['user']);
            $usuario->setPassword ($_POST['password']);
            $usuario->setName ($_POST['name']);
            $usuario->setEmail ($_POST['email']);
            $usuario->setAddress ($_POST['address']);
            $usuario->setPostalCode ($_POST['postalcode']);

            $error = $usuario->insert();

            if (!$error) {
                header( "Location: index.php?controller=products&action=view");
            }
            else {
                echo $error;
            }
        }

    }
?>
