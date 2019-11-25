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
        <title>Nuevo Mensaje</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php $codigo = $_GET['codigo']; ?>
        <header class="header">
        <nav>
            <ul>
                <li><a href="index.php?codigo=<?php echo $codigo ?>">Inicio</a></li>
                <li><a href="nuevo_mensaje.php?codigo=<?php echo $codigo ?>">Nuevo Mensaje</a></li>
                <li><a href="mensajes_enviados.php?codigo=<?php echo $codigo ?>">Mensajes Enviados</a></li>
                <li><a href="micuenta.php?codigo=<?php echo $codigo ?>">Mi cuenta</a></li>
                <li><a href="../../../config/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
        </header>
        <main class="main">
        <form id="formulario01" method="POST" action="../../controladores/user/nuevo_mensaje.php">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

            <label for="remite">From:</label>
            <input type="text" id="remite" name="remite" value="<?php echo buscarCorreo($codigo) ?>" disabled>
            <br>

            <label for="destino">To:</label>
            <input type="text" id="destino" name="destino" value="">
            <br>

            <label for="asunto">Asunto: </label>
            <input type="text" id="asunto" name="asunto" value="">
            <br>

            <label for="mensaje">Mensaje</label>
            <input type="text" id="mensaje" name="mensaje" value="">
            <br>

            <input type="submit" id="enviar" name="enviar" value="Enviar">
            <input type="reset" id="cancelar" name="cancelar" value="Cancelar">
        </form>
        <br>
        <br>
        <br>
        <br>
        <footer>
        <br>
            <p>Desarrollado por: Jonathan Matute <br><em> © Todos los derechos reservados</em></p>
        <br>
        </footer>
    </body>
</html>
<?php
    function buscarCorreo($codigoCorreo){
        include '../../../config/conexionBD.php';
        $sql1 = "SELECT usu_correo FROM usuario WHERE usu_codigo='$codigoCorreo'";
        $result = $conn->query($sql1);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $direccionCorreo=$row["usu_correo"];
            }
        }
        return $direccionCorreo;
    }
?>