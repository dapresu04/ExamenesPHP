<?php
    session_start(); 
   $usuario= $_SESSION["usuario"] ; 
    if(!isset($_SESSION["pulsaciones"])){
        $_SESSION["pulsaciones"] =0; 
    }
    if(isset($_POST["incrementar"])){
        if($_SESSION["pulsaciones"] <5){
            $_SESSION["pulsaciones"]++;
        }else if($_SESSION["pulsaciones"]==5){
            header("Location: agenda.php");
            exit();
        }
    }
    $emojis = ["OIP0.jfif", "OIP1.jfif", "OIP2.jfif", "OIP3.jfif", "OIP4.jfif"];
    if(isset($_POST["reset"])){
        $_SESSION["pulsaciones"]=0; 
    }
    if(isset($_POST["grabar"])){
        $_SESSION["pulsaciones"]; 
        header("Location: agenda.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 180px;
            height: 150px;
            margin: 5px;
        }

    </style>
</head>
<body>
    <h1>Agenda</h1>
    <h3>Hola, <?php echo $usuario?> cuantos contactos desear grabar?</h3>
    <h3>Puedes grabar entre 1 y 5. 
        Por cada pulsación en INCREMENTAR grabarás un usuario más.
    </h3>
    <h3>Cuando el numero sea el deseado pulsa GRABAR</h3>
    <?php
        for ($i = 0; $i < $_SESSION["pulsaciones"]; $i++) {
            echo "<img src='{$emojis[$i]}' alt='emoji' />";
        }
    ?>
    <form method="POST" action="">
        <button type="submit" name="incrementar">INCREMENTAR</button>
        <button type="submit" name="grabar">GRABAR</button>
        <button type="submit" name="reset">Resetear</button>
    </form>
</body>
</html>