<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-*">
    <title>Eliminar Reunion</title>
    <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
</head>

<body>
    <?php
    $codigo_admin = $_GET["codigo_admin"];
    $codigo_reunion = $_GET["codigo_reunion"];
    $sql = "SELECT * FROM reunion WHERE reu_codigo=$codigo_reunion";

    include '../../../config/conexionBD.php';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <form class="box" method="POST" action="../../controladores/admin/eliminar_reunion.php?codigo_admin=<?php echo $codigo_admin ?>&codigo_reunion=<?php echo $row["reu_codigo"]; ?>">


            <label class="elimina" for="remitente">Remitente</label>
                <input type="text" id="remitente" name="remitente" value="<?php echo buscarCorreo($row["reu_usu_remite"]); ?>" disabled>
                <br>
                <label class="elimina" for="destinatario">Destinatario</label>
                <input type="text" id="destinatario" name="destinatario" value="<?php echo buscarCorreo($row["reu_usu_destino"]); ?>" disabled>
                <br>
                <label class="elimina" for="motivo">Motivo</label>
                <input type="text" id="motivo" name="motivo" value="<?php echo $row["reu_motivo"]; ?>" disabled>
                <br>
                <label class="elimina" for="observacion">Observacion</label>
                <input type="text" id="observacion" name="observacion" value="<?php echo $row["reu_observacion"]; ?>" disabled>
                <br>
                <label class="elimina" for="fecha_envio">Fecha</label>
                <input type="text" id="fecha_envio" name="fecha_envio" value="<?php echo $row["reu_fecha_encuentro"]; ?>" disabled>
                <br>
                <label class="elimina" for="lugar">Lugar</label>
                <input type="text" id="lugar" name="lugar" value="<?php echo $row["reu_lugar"]; ?>" disabled>
                <br>
                <label class="elimina" for="latitud">latitud</label>
                <input type="text" id="latitud" name="latitud" value="<?php echo $row["reu_latitud"]; ?>" disabled>
                <br>
                <label class="elimina" for="longitud">longitud</label>
                <input type="text" id="longitud" name="longitud" value="<?php echo $row["reu_longitud"]; ?>" disabled>
                <br>
                <input class="boton" type="submit" id="eliminar" name="eliminar" value="Eliminar">
                <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='index.php?codigo_admin=<?php echo $codigo_admin ?>'" class="boton">
            </form>
    <?php
        }
    } else {
        echo "<p>Ha ocurrido un error inesperado!!!</p>";
        echo "<p>" . mysqli_error($conn) . "</p>";
    }


    function buscarCorreo($codigoCorreo)
    {
        include '../../../config/conexionBD.php';
        $sql1 = "SELECT usu_correo FROM usuario WHERE usu_codigo='$codigoCorreo'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $direccionCorreo = $row["usu_correo"];
            }
        }
        return $direccionCorreo;
    }

    function buscarId($codigo_usu)
    {
        include '../../../config/conexionBD.php';
        $sql1 = "SELECT usu_nombres FROM usuario WHERE usu_codigo='$codigo_usu'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigo_usu = $row["usu_codigo"];
            }
        }
        return $codigo_usu;
    }

    $conn->close();


    ?>
</body>

</html>