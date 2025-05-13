<?php
     session_start(); 
    include_once "conexion.php"; 

    $conexion = new mysqli($localhost, $usuario, $pw, $database); 
    if($conexion->connect_error){
        die("Conexion fallida"); 
    }

    $usu = $_SESSION["usuario"]; 
    $id_usu = $_SESSION["id_usu"];
    $rol = $_SESSION["rol"]; 
    $pulsaciones = $_SESSION["pulsaciones"];
    var_dump($usu, $id_usu, $rol, $pulsaciones);

    $rol = $conexion ->prepare("SELECT Rol FROM usuario"); 
    $rol = bind_param("s", $rol);
     $result = $rol->get_result(); 

     if($result -> num_rows>0){
        
     }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>