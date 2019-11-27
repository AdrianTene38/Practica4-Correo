<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nueva Reunion</title>
    <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
</head>

<body onload="getLocation()">
    <?php $codigo = $_GET['codigo']; ?>
    <header class="header">
        <nav>
            <ul>
                <li><a href="index.php?codigo=<?php echo $codigo ?>">Inicio</a></li>
                <li><a href="micuenta.php?codigo=<?php echo $codigo ?>">Mi cuenta</a></li>
                <li><a href="../../../config/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <form id="formulario01" method="POST" action="../../controladores/user/nueva_reunion.php">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

            <label for="remite">De:</label>
            <input type="text" id="remite" name="remite" value="<?php echo buscarCorreo($codigo) ?>" readonly>
            <br>
            <label for="destino">para:</label>
            <input type="text" id="destino" name="destino" value="" required>
            <br>
            <label for="motivo">Motivo: </label>
            <input type="text" id="motivo" name="motivo" value="" required>
            <br>
            <label for="observacion">Observacion</label>
            <input type="text" id="observacion" name="observacion" value="" required>
            <br>
            <label for="fecha">Fecha Encuentro</label>
            <input type="datetime-local" id="fechaEncuentro" name="fechaEncuentro" value="" required />
            <br><br>
            <label for="lugar">Lugar: </label>
            <input type="text" id="lugar" name="lugar" value="" required>
            <br>
            <label for="latitud">Latitud:</label>
            <input type="text" id="latitud" name="latitud" readonly>
            <br>
            <label for="longitud">Longitud:</label>
            <input type="text" id="longitud" name="longitud" readonly>
            <br>
            <input type="submit" id="enviar" name="enviar" value="Enviar">
            <input type="reset" id="cancelar" name="cancelar" value="Cancelar">

        </form>
</body>

</html>
<?php
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
?>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        document.getElementById("latitud").value = position.coords.latitude;
        document.getElementById("longitud").value = position.coords.longitude;
    }
</script>