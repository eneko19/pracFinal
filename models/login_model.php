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
* Inserta un registre a la taula
* @return [false]  si no hi ha hagut cap error,
*         [string] amb text d'error si no ha anat bé
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
* Consula los usuarios de la tabla
* @return array Bidimensional de tots els usuaris de la taula
*/
public function consultar_usuario(){
    $consulta=("SELECT * FROM USER WHERE USERNAME ='{$this->usuario}' AND PASSWORD = '{$this->password}';");

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
