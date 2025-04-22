<?php
    $localhost = "localhost"; 
    $username = "root"; 
    $pw = ""; 
    $database = "agenda"; 

    $conexion = new mysqli($localhost, $username, $pw, $database); 

    if($conexion -> connect_error){
        die("Error de conexions");
    }else{
        echo "conexion existossa";
    }

?>