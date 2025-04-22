<?php
session_start(); 
require_once "conexion.php"; 
$usuario = $_SESSION["usuario"]; 
$contador = $_SESSION["pulsaciones"]; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>AGENDA</h1>
    <h3>Hola <?php echo $usuario?></h3>
    <table>
        
    </table>
</body>
</html>