<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Eliminar Reunion</title>
    <link rel="stylesheet" rel="stylesheet" href="../../../index.css">
</head>

<body>
    <?php
    //Incluir conexion a la BD
    include '../../../config/conexionBD.php';
    $codigo_admin = $_GET["codigo_admin"];
    $codigo_reunion = $_GET["codigo_reunion"];
    date_default_timezone_set("America/Guayaquil");
    $fecha = date("Y-m-d H:i:s", time());
    $sql = "UPDATE reunion SET reu_eliminado = 'S' WHERE reu_codigo = '$codigo_reunion'";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Se ha eliminado el mensaje electronico correctamente</p>";
    } else {
        echo "<p>Error" . $sql . "<br>" . mysqli_error($conn) . "</p>";
    }
    echo "<a href='../../vista/admin/index.php?codigo_admin=" . $codigo_admin . "'>Regresar</a>";
    $conn->close();
    ?>
</body>

</html>