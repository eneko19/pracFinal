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

            $usuario->setUserName ($_POST['username']);
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
        /**
         * Si el login falla vuelve a abrir el modal de inicio de sesión
         * @return string script que habre el modal
         */
        function loginFailed() {

        $abrirModal = "<script type='text/javascript'>
         $(document).ready(function(){
         $('#myModal').modal('show');
         });
         </script>";
        return $abrirModal;

    }


      /**
       * Finaliza la sesión de usuario
       */
        function logout(){
           // Borra contingut de $_SESSION
           session_unset();
           // elimina la sessio
           session_destroy();
        }
    }
?>
