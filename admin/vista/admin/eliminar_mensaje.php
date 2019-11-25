<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: /Practica04-Mi-Correo-Electronico/public/vista/login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-*">
        <title>Eliminar Mensaje Electronico</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php
            $codigo_admin = $_GET["codigo_admin"];
            $codigo_mensaje = $_GET["codigo_mensaje"];
            $sql = "SELECT * FROM correo WHERE cor_codigo=$codigo_mensaje";

            include '../../../config/conexionBD.php';
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
        ?>
                    <form class="box" method="POST" action="../../controladores/admin/eliminar_mensaje.php?codigo_admin=<?php echo $codigo_admin ?>&codigo_mensaje=<?php echo $row["cor_codigo"]; ?>">
                        

                        <label class="elimina" for="fecha_envio">Fecha</label>
                        <input  type="text" id="fecha_envio" name="fecha_envio" value="<?php echo $row["cor_fecha_envio"];?>" disabled>
                        <br>
                        <label class="elimina" for="remitente">Remitente</label>
                        <input type="text" id="remitente" name="remitente" value="<?php echo buscarCorreo($row["cor_usu_remite"]);?>" disabled>
                        <input type="hidden" id="remitente_c" name="remitente_c" value="<?php echo $row["cor_usu_remite"];?>" disabled>
                        <br>
                        <label class="elimina" for="destinatario">Destinatario</label>
                        <input type="text" id="destinatario" name="destinatario" value="<?php echo buscarCorreo($row["cor_usu_destino"]);?>" disabled>
                        <input type="hidden" id="destinatario_c" name="destinatario_c" value="<?php echo $row["cor_usu_destino"];?>" disabled>
                        <br>
                        <label class="elimina" for="asunto">Asunto</label>
                        <input type="text" id="asunto" name="asunto" value="<?php echo $row["cor_asunto"];?>" disabled>
                        <br>
                        <input class="boton" type="submit" id="eliminar" name="eliminar" value="Eliminar">
                        <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='index.php?codigo_admin=<?php echo $codigo_admin ?>'" class="boton">
                    </form>
        <?php
                }
            }else{
                echo "<p>Ha ocurrido un error inesperado!!!</p>";
                echo "<p>".mysqli_error($conn)."</p>";
            }
            

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

            $conn->close();


        ?>            
    </body>
</html>