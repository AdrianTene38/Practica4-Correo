<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar Mensaje Electronico</title>
    </head>
    <body>
        <?php

            //Incluir conexion a la BD
            include '../../../config/conexionBD.php';

            $codigo_admin = $_GET["codigo_admin"];
            $codigo_mensaje = $_GET["codigo_mensaje"];

            date_default_timezone_set("America/Guayaquil");
            $fecha = date("Y-m-d H:i:s",time());
            $sql = "UPDATE correo SET cor_eliminado = 'S', cor_elimina = '$codigo_admin', cor_fecha_elimina = '$fecha' WHERE cor_codigo = '$codigo_mensaje'";

            if ($conn->query($sql) === TRUE){
                echo "<p>Se ha eliminado el mensaje electronico correctamente</p>";
            }else{
                echo "<p>Error".$sql."<br>".mysqli_error($conn)."</p>";
            }
            echo "<a href='../../vista/admin/index.php?codigo_admin=".$codigo_admin."'>Regresar</a>";

            $conn->close();
        ?>
    </body>
</html>