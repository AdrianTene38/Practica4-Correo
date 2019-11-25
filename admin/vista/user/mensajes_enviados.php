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
            <title>Mensajes Enviados</title>
            <script type="text/javascript" src="ajax2.js"></script>
            <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
        </head>
        <body>
        <?php
            include '../../../config/conexionBD.php';
            $codigo = $_GET['codigo'];
        ?>
            <?php
                $codigo = $_GET['codigo'];
            ?>
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
        
        <section class="info">
            <?php
                $sqli ="SELECT usu_imagen,usu_nombres,usu_apellidos FROM usuario WHERE usu_codigo='$codigo'";
                $stm = $conn->query($sqli);
                while ($datos = $stm->fetch_object()){
            ?>
                <p><?php echo $datos->usu_nombres." ".$datos->usu_apellidos ?></p>
                <img src="data:image/jpg; base64,<?php echo base64_encode($datos->usu_imagen) ?>">
            <?php   
                }
            ?>
          </section>
           
            <section class="mensajes">
                <h3>Mensajes Enviados</h3>
                <form id="form_mensajes">
                <form id="form_mensajes"><input type="text" id="correoBuscar" name="correoBuscar" value="" onkeyup="buscarC2(<?php echo $codigo ?>)" placeholder="Buscar por correo...">
                    <div id="informacion">
                    <table  id="buzon">
                        <tr>
                            <th>Destino</th>
                            <th>Destino</th>
                            <th>Mensaje</th>
                            <th>Fecha y hora de envio</th>
                        </tr>
                        <?php
                            include '../../../config/conexionBD.php';
    
    
                            $sql = "SELECT * FROM correo WHERE cor_usu_remite='$codigo' ORDER BY cor_fecha_envio";
                            $result = $conn->query($sql);
                            
    
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>".buscarCorreo($row["cor_usu_destino"])."</td>";
                                        echo "<td>" .$row["cor_asunto"]."</td>";
                                        echo "<td>" .$row["cor_mensaje"]."</td>";
                                        echo "<td>" .$row["cor_fecha_envio"]."</td>";
                                }
                            }else{
                                echo "<td colspan=4>No tiene mensajes enviados</td>ERROR";
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
                </table>
            </form>
        </section>
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