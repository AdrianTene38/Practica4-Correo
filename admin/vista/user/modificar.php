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
        <title>Modificar datos de persona</title>
        <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
    </head>
    <body>
        <?php
            $codigo = $_GET["codigo"];
            $sql = "SELECT * FROM usuario where usu_codigo=$codigo";

            include '../../../config/conexionBD.php';
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
        ?>
                    <form class="box" method="POST" action="../../controladores/user/modificar.php">
                        <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

                        <label class="modificar" for="cedula">Cedula (*)</label>
                        <input type="text" id="cedula" name="cedula" value="<?php echo $row["usu_cedula"]; ?>" required_placeholder="Ingrese la cedula...">
                        <br>

                        <label class="modificar" for="nombres">Nombres (*)</label>
                        <input type="text" id="nombres" name="nombres" value="<?php echo $row["usu_nombres"]; ?>" required_placeholder="Ingrese los dos nombres...">
                        <br>

                        <label class="modificar" for="apellidos">Apellidos (*)</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo $row["usu_apellidos"]; ?>" required_placeholder="Ingrese los dos apellidos...">
                        <br>

                        <label class="modificar" for="direccion">Direccion (*)</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $row["usu_direccion"]; ?>" required_placeholder="Ingrese los direccion...">
                        <br>

                        <label class="modificar" for="telefono">Telefono (*)</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo $row["usu_telefono"]; ?>" required_placeholder="Ingrese el telefono...">
                        <br>

                        <label class="modificar" for="fecha">Fecha Nacimiento (*)</label>
                        <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $row["usu_fecha_nacimiento"]; ?>" required_placeholder="Ingrese la fecha de nacimiento...">
                        <br>

                        <label class="modificar" for="correo">Correo electronico (*)</label>
                        <input type="email" id="correo" name="correo" value="<?php echo $row["usu_correo"]; ?>" required_placeholder="Ingrese el correo electronico...">
                        <br>

                        <input type="submit" id="modificar" name="modificar" value="Modificar" class="boton" >
                        <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='micuenta.php?codigo=<?php echo $codigo ?>'" class="boton">
                    </form>
        <?php            
                }
            }else{
                echo "<p>Ha ocurrido un error inesperdado</p>";
                echo "<p>".mysqli_error($conn)."</p>";
            }
            $conn->close();
        ?>
    </body>
</html>