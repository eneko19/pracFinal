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

      $username = !empty($_POST['user']) ? $_POST['user'] : "";
      $password = !empty($_POST['password']) ? $_POST['password'] : "";

      $usuario->setUsername($username);
      $usuario->setPassword($password);

      $ok = $usuario->consultar_usuario();

          if ($ok) {
            $_SESSION['usuario'] = $username;
            require_once("views/home.phtml");
            return true;
          }
          else {
              return false;
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
