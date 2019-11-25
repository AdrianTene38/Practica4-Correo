<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: /Practica04-Mi-Correo-Electronico/public/vista/login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modificar Avatar</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php
            $codigo = $_GET["codigo"];
        ?>
                    <form class="box" method="POST" action="../../controladores/user/cambiar_imagen.php?codigo=<?php echo $codigo ?>" enctype="multipart/form-data">
                        <h3>Selecciona una imagen</h3>
                        <br>
                        <input type="file" name="txtImg">
                        <br>
                        <button class="boton" type="submit" name="aceptar">Aceptar</button>
                        <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='micuenta.php?codigo=<?php echo $codigo ?>'" class="boton">
                    </form>
    </body>
</html>
