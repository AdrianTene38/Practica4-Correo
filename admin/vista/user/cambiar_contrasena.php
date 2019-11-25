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
        <title>Cambiar Contrasena</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php
            $codigo = $_GET["codigo"];
        ?>
        <form class="box" method="POST" action="../../controladores/user/cambiar_contrasena.php">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

            <label class="contrasena" for="contrasenaActual">Contrasena Actual (*)</label>
            <input type="password" id="contrasena1" name="contrasena1" value="" required placeholder="Ingrese su contrasena actual...">
            <br>

            <label class="contrasena" for="contrasenaNueva">Contrasena Nueva (*)</label>
            <input type="password" id="contrasena2" name="contrasena2" value="" required placeholder="Ingrese su contrasena nueva...">
            <br>

            <input type="submit" id="modificar" name="modificar" value="Modificar" class="boton">
            <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='micuenta.php?codigo=<?php echo $codigo ?>'" class="boton">
        </form>
    </body>
</html>