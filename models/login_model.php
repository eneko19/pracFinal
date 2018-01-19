<?php
class login_model {

private $db;
private $usuario;
private $password;

public function __construct(){
    $this->db=Conectar::conexion();
}

/* GETTERS & SETTERS */

public function getUsuario() {
    return $this->usuario;
}

public function setUsuario($usuario) {
    $this->usuario = $usuario;
}

public function getPassword() {
    return $this->password;
}

public function setPassword($password) {
    $this->password = $password;
}


/**
* Consula los usuarios de la tabla
* @return array Bidimensional de tots els usuaris de la taula
*/
public function consultar_usuario(){
    $consulta=("SELECT * FROM usuarios WHERE usuario ='{$this->usuario}' AND password = '{$this->password}';");

     $resultado = $this->db->query($consulta) or trigger_error(mysqli_error($this->db)." ".$consulta);

     if ($resultado->num_rows > 0) {
     while($row=$resultado->fetch_assoc()){
       return true;
     }
   } else {
       return false;
     }
}

}
?>
