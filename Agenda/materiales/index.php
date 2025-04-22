<?php
session_start();
require_once "conexion.php"; 

$conexion = new mysqli($localhost, $username, $pw, $database); 
    if($conexion->connect_error){
        die ("conexion fallida"); 
        exit();   
       
    }else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(isset($_POST["usuario"]) && isset($_POST["contra"])){
               $usuario= $_POST["usuario"]; 
              $contra= $_POST["contra"]; 
                
                $sql = $conexion->prepare("SELECT * FROM usuarios WHERE 
                Nombre = ? AND Clave =?"); 

                $sql->bind_param("ss", $usuario, $contra); 
                $sql->execute(); 
                $result=$sql->get_result(); 
                if($result->fetch_assoc()){
                    $_SESSION["usuario"] =$usuario; 
                    header("Location: inicio.php");
                    exit();
                }else{
                    $_SESSION["error"] =1; 
                     header("Location: index.php");
                    exit();
                } 
            }
        }
                       
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
    <form method="POST" action="">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario"/>
        <label for="contra">Contraseña</label>
        <input type="password" name="contra"/>
        <button type="submit" name="entrar">Entrar</button>
    </form>
    <?php
        if(isset($_SESSION["error"])){
            echo "
                <p style='color:red'>Credenciales incorrectas...</p>
            ";
        }
    ?>
</body>
</html>