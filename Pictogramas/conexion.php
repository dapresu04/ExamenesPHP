<?php
    $localhost = "localhost"; 
    $usuario = "root"; 
    $pw = ""; 
    $database = "pictograma"; 

    $conexion = new mysqli ($localhost, $usuario, $pw, $database); 
    if(!$conexion){
        die("error de conexion");
    }else{
        echo "Conexion existosa"; 
    }

?>