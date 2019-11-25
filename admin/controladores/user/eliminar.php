<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar datos de persona</title>
    </head>
    <body>
        <?php
            include '../../../config/conexionBD.php';

            $codigo = $_POST["codigo"];

            date_default_timezone_set("America/Guayaquil");
            $fecha = date("Y-m-d H:i:s",time());
            $sql = "UPDATE usuario SET usu_eliminado = 'S', usu_fecha_modificacion = '$fecha' WHERE usu_codigo = '$codigo'";

            if ($conn->query($sql) == TRUE){
                echo "<p>Se ha eliminado los datos correctamente</p>";
                include '../../../config/cerrar_sesion.php';
            }else{
                echo "<p>Error".$sql."<br>".mysqli_error($conn)."</p>";
            }

            $conn->close();
        ?>
    </body>
</html>