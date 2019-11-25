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
        <title>Mi Cuenta</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php 
        include '../../../config/conexionBD.php';
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
        <table id="buzon">
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Fecha Nacimiento</th>
                <th>Avatar</th>
                <th>Eliminar</th>
                <th>Modificar</th>
                <th>Cambiar contrasena</th>
            </tr>

            <?php
                include '../../../config/conexionBD.php';

                $sql = "SELECT * FROM usuario WHERE usu_codigo='$codigo'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["usu_eliminado"]!='S'){
                            echo "<tr>";
                            echo "<td>" .$row["usu_cedula"]."</td>";
                            echo "<td>" .$row["usu_nombres"]."</td>";
                            echo "<td>" .$row["usu_apellidos"]."</td>";
                            echo "<td>" .$row["usu_direccion"]."</td>";
                            echo "<td>" .$row["usu_telefono"]."</td>";
                            echo "<td>" .$row["usu_correo"]."</td>";
                            echo "<td>" .$row["usu_fecha_nacimiento"]."</td>";
                            echo "<td class='accion'><a href='cambiar_imagen.php?codigo=".$row['usu_codigo']."'>Editar</a></td>";
                            echo "<td class='accion'><a href='eliminar.php?codigo=".$row['usu_codigo']."'>Eliminar</a></td>";
                            echo "<td class='accion'><a href='modificar.php?codigo=".$row['usu_codigo']."'>Modificar</a></td>";
                            echo "<td class='accion'><a href='cambiar_contrasena.php?codigo=".$row['usu_codigo']."'>Cambiar contrasena</a></td>";
                        }
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='8'>No existen usuarios registrados en el sistema</td>";
                    echo "</tr>";
                }
                $conn->close();
            ?>
        </table>
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