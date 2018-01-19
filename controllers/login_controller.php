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
 * Inserta a la taula
 * @return No
 */
  function login() {
      $usuario = new login_model();

      $usuario->setUsuario($_POST['usuario']);
      $usuario->setPassword($_POST['password']);

      $ok = $usuario->consultar_usuario();

          if ($ok) {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];
            header( "Location: index.php?controller=personas&action=view");
          }
          else {
              header( "Location: index.php?controller=login&action=view");
          }
      }

    }
?>
