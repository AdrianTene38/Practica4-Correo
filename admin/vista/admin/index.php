<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: /Practica04-Mi-Correo-Electronico/public/vista/login.html");
    }
    ?>
    <!DOCTYPE html>
    <html>
        <?php
            include '../../../config/conexionBD.php';
            $codigo_admin = $_GET['codigo_admin'];
        ?>
        <head>
            <meta charset="UTF-8">
            <title>Sistema de Gestion de Mensajes Electronicos</title>
            <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
        </head>
        <body>
        <header class="header">
            <nav>
                <ul>
                    <li><a href="index.php?codigo_admin=<?php echo $codigo_admin ?>">Inicio</a></li>
                    <li><a href="usuarios.php?codigo_admin=<?php echo $codigo_admin ?>">Usuarios</a></li>
                    <li><a href="../../../config/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
            </header>
            <main class="main">
            <section class="info">
                <?php
                    $sqli ="SELECT usu_imagen,usu_nombres,usu_apellidos FROM usuario WHERE usu_codigo='$codigo_admin'";
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
                <h3>Mensajes Electronicos</h3>
                <form class="form_mensajes">
                    <table id="buzon">
                        <tr>
                            <th>Fecha</th>
                            <th>Remite</th>
                            <th>Destinatario</th>
                            <th>Asunto</th>
                            <th>Accion</th>
                        </tr>
                        <?php
                            include '../../../config/conexionBD.php';
    
    
                            $sql = "SELECT * FROM correo ORDER BY cor_fecha_envio";
                            $result = $conn->query($sql);
                            
    
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    if($row["cor_eliminado"]!='S'){
                                        echo "<tr>";
                                        echo "<td>" .$row["cor_fecha_envio"]."</td>";
                                        echo "<td>".buscarCorreo($row["cor_usu_remite"])."</td>";
                                        echo "<td>".buscarCorreo($row["cor_usu_destino"])."</td>";
                                        echo "<td>" .$row["cor_asunto"]."</td>";
                                        echo "<td class='accion'><a href='eliminar_mensaje.php?codigo_mensaje=".$row['cor_codigo']."&codigo_admin=".$codigo_admin."'>Eliminar</a></td>";
                                    }
                                }
                            }else{
                                echo "<td colspan=4>No hay mensajes electronicos</td>";
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
        <footer>
				<p>Desarrollado por:<br> Jonathan Matute</p>
			    <p><sub>&#169;</sub><em> Todos los derechos reservados</em></p>
			    <br>
        </footer>
    </body>
</html>