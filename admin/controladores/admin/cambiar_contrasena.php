<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cambiar Contrasena</title>
    </head>
    <body>
        <?php
            //Incluir conexion a la BD
            include "../../../config/conexionBD.php";
            $codigo_admin = $_GET["codigo_admin"];
            $codigo = $_POST["codigo"];
            $contrasena2 = isset($_POST["contrasena2"]) ? trim($_POST["contrasena2"]) : null;

            $sqlContrasena1 = "SELECT * FROM usuario WHERE usu_codigo=$codigo";
            $result = $conn->query($sqlContrasena1);

            if ($result->num_rows > 0){
                date_default_timezone_set("America/Guayaquil");
                $fecha = date('Y-m-d H:i:s',time());

                $sqlContrasena2 = "UPDATE usuario SET usu_password=MD5($contrasena2), usu_fecha_modificacion='$fecha' WHERE usu_codigo=$codigo";

                if ($conn->query($sqlContrasena2) === TRUE){
                    echo "Se ha actualizado la contrasena correctamente";
                }else{
                    echo "<p>Error: ".mysqli_error($conn)."</p>";
                }
            }else{
                echo "<p>La contrasena actual no coincide con nuestros registros!!!</p>";
            }
            echo "<a href='../../vista/admin/usuarios.php?codigo_admin=".$codigo_admin."'>Regresar</a>";
            $conn->close();
        ?>
    </body>
</html>