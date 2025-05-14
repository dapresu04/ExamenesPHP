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

    $buscar = $conexion ->prepare("SELECT Rol FROM usuarios WHERE Rol = ?"); 
    $buscar -> bind_param("s", $rol);
    $buscar->execute();
     $result = $buscar->get_result(); 

     if($result -> num_rows>0){
        $fila = $result->fetch_assoc(); 
        $rol = $fila["Rol"];
     }else{
        echo "no existe el usuario con rol";
     }
     if(isset($_POST["accion"])){
        $accion = $_POST['accion'];
     switch($accion){
        case 'ver': 
             $informacion = $conexion -> prepare("SELECT u.Codigo, u.Nombre, COUNT(c.codcontacto) AS contactos
                FROM usuarios u
                LEFT JOIN contactos c ON u.Codigo = c.codusuario
                GROUP BY u.Codigo, u.Nombre
               /* HAVING contactos>2 */
                ");
                    //$informacion->bind_param("i", $id_usu);
                $informacion->execute(); 
                $result = $informacion->get_result(); 
                $contactos =0; 
                if($result->num_rows>0){
                    echo "<table border='1' cellpadding='5' cellspacing='0'>";
                    echo "<tr><th>Codigo Usuario</th><th>Nombre</th><th>Numero de contactos</th></tr>";
                    while($fila = $result -> fetch_assoc()){
                        $codigoUsu = $fila["Codigo"];
                        $nombreUsu = $fila["Nombre"];
                        $contactos = $fila["contactos"];
                        echo "<tr>
                            <td>$codigoUsu</td>
                            <td>$nombreUsu</td>
                            <td>$contactos</td>
                        </tr>";
                }

                    echo "</table>";
            }
    
        break;  
        case 'aniadir': 
            header("Location: inicio.php");
            exit();
        break;     
        case 'editar': 
            echo '
                <form method="POST">
                    <label for="usuario">Buscar por nombre</label>
                    <input type="text" name="usuario"/>
                    <button type="submit" name="buscar">Buscar</button>
                </form>
            
            ';
         
            if(isset($_POST["usuario"]) && $_POST["buscar"]){
                $nombre = $_POST["usuario"];
                $buscar = $conexion->prepare("SELECT Nombre FROM usuarios WHERE Nombre=?");
                $buscar -> bind_param("s", $nombre); 
                $buscar->execute(); 
                $result = $buscar->get_result();
                if($result->num_rows>0){
                     $fila = $result->fetch_assoc();
            echo "<p>Usuario encontrado: <strong>{$fila['Nombre']}</strong> (Código: {$fila['Codigo']})</p>";
            // Aquí podrías generar otro formulario para editar los datos, si quieres.
        } else {
            echo "<p style='color:red;'>Usuario no encontrado</p>";
        }
            }
        break;       
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
    <?php
        if($rol === "admin"):

    ?>
    <p>Rol de administrador</p>
    <form action="" method="POST">
        <button type="submit" name="accion" value="ver">Ver</button>
        <button type="submit" name="accion" value="aniadir">Añadir</button>
        <button type="submit" name= "accion" value="editar">Editar</button>
        <button type="submit" name="accion" value="borrar">Borrar</button>
    </form>
    <?php elseif($rol === "usuario"):?>
        <p>Rol de Usuario</p>
    <?php endif; ?> 
</body>
</html>