<table id="buzon">
    <tr>
        <th>De</th>
        <th>Para</th>
        <th>Motivo</th>
        <th>Observacion</th>
        <th>Fecha y hora reunion</th>
        <th>Lugar</th>
        <th>Latitud</th>
        <th>Longitud</th>
    </tr>
    <?php
    include '../../../config/conexionBD.php';

    $codigo = $_GET["codigo"];
    $motivo = $_GET["motivo"];

    $sql = "SELECT * FROM reunion  WHERE  (reu_usu_destino='$codigo' or reu_usu_remite = '$codigo') AND reu_motivo like '%$motivo%' ORDER BY reu_fecha_encuentro ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . buscarCorreo($row["reu_usu_remite"]) . "</td>";
            echo "<td>" . buscarCorreo($row["reu_usu_destino"]) . "</td>";
            echo "<td>" . $row["reu_motivo"] . "</td>";
            echo "<td>" . $row["reu_observacion"] . "</td>";
            echo "<td>" . $row["reu_fecha_encuentro"] . "</td>";
            echo "<td>" . $row["reu_lugar"] . "</td>";
            echo "<td>" . $row["reu_latitud"] . "</td>";
            echo "<td>" . $row["reu_longitud"] . "</td>";
        }
    } else {
        echo "<td colspan=7>No tiene reuniones con el motivo ingresado</td>";
    }

    function buscarCodigoCorreo($correo)
    {
        $codigoCorreo = "";
        include '../../../config/conexionBD.php';
        $sql1 = "SELECT usu_codigo FROM usuario WHERE usu_correo='$correo'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $codigoCorreo = $row["usu_codigo"];
            }
        }
        return $codigoCorreo;
    }
    function buscarCorreo($codigoCorreo1)
    {
        include '../../../config/conexionBD.php';
        $sql1 = "SELECT usu_correo FROM usuario WHERE usu_codigo='$codigoCorreo1'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $direccionCorreo = $row["usu_correo"];
            }
        }
        return $direccionCorreo;
    }


    $conn->close();
    ?>
</table>