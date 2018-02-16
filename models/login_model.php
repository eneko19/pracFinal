<?php
class login_model {

private $db;
private $username;
private $password;
private $creationDate;
private $name;
private $email;
private $address;
private $postalcode;

public function __construct(){
    $this->db=Conectar::conexion();
}

/* GETTERS & SETTERS */

public function getUsername() {
    return $this->username;
}

public function setUsername($username) {
    $this->username = $username;
}

public function getPassword() {
    return $this->password;
}

public function setPassword($password) {
    $this->password = $password;
}

public function getCreationDate() {
    return $this->creationDate;
}

public function setCreationDate($creationDate) {
    $this->creationDate = $creationDate;
}

public function getName() {
  return $this->name;
}

public function setName($name) {
  $this->name = $name;
}

public function getEmail() {
  return $this->email;
}

public function setEmail($email) {
  $this->email = $email;
}

public function getAddress() {
  return $this->address;
}

public function setAddress($address) {
  $this->address = $address;
}

public function getPostalCode() {
  return $this->postalcode;
}

public function setPostalCode($postalcode) {
  $this->postalcode = $postalcode;
}

/*********** FUNCIONES **************/

/**
* Inserta un registro a la tabla
* @return [false]  si no ha habido ningún error,
*         [string] devyulve la swl y el error cuando ha habido algún problema
*/
public function insert() {
     $sql = "INSERT INTO USER (USERNAME, PASSWORD, NAME,EMAIL,ADDRESS,POSTALCODE)
             VALUES ('{$this->username}','{$this->password}','{$this->name}','{$this->email}',
             '{$this->address}','{$this->postalcode}')";

     $result = $this->db->query($sql);

     if ($this->db->error)
         return "$sql<br>{$this->db->error}";
     else {
         return false;
     }
}

/**
* Consula los usuarios de la tabla por usuario y contraseña
* @return array Bidimensional del usuario que sea igual a la consulta
*/
public function consultar_usuario(){
    $consulta=("SELECT * FROM USER WHERE USERNAME ='{$this->username}' AND PASSWORD = '{$this->password}';");

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
