<?php

/**
 * Classe con método estático que sirve para conectarse a la Base de Datos
 */
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "user", "user", "computerstore");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
