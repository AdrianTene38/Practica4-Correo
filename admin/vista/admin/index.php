<?php
session_start();
if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE) {
    header("Location: /SistemaDeGestion/public/vista/login.html");
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
    <title>Sistema de Gestion de Reuniones</title>
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
            $sqli = "SELECT usu_imagen,usu_nombres,usu_apellidos FROM usuario WHERE usu_codigo='$codigo_admin'";
            $stm = $conn->query($sqli);
            ?>
        </section>
        <section class="mensajes">
            <h3>Reuniones</h3>
            <form class="form_mensajes">
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
                        <th>Eliminar</th>
                    </tr>
                    <?php
                    include '../../../config/conexionBD.php';


                    $sql = "SELECT * FROM reunion ORDER BY reu_fecha_encuentro";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row["reu_eliminado"] != 'S') {
                                echo "<tr>";
                                echo "<td>" . buscarCorreo($row["reu_usu_remite"]) . "</td>";
                                echo "<td>" . buscarCorreo($row["reu_usu_destino"]) . "</td>";
                                echo "<td>" . $row["reu_motivo"] . "</td>";
                                echo "<td>" . $row["reu_observacion"] . "</td>";
                                echo "<td>" . $row["reu_fecha_encuentro"] . "</td>";
                                echo "<td>" . $row["reu_lugar"] . "</td>";
                                echo "<td>" . $row["reu_latitud"] . "</td>";
                                echo "<td>" . $row["reu_longitud"] . "</td>";
                                echo "<td class='accion'><a href='eliminar_reunion.php?codigo_reunion=" . $row['reu_codigo'] . "&codigo_admin=" . $codigo_admin . "'>Eliminar</a></td>";
                            }
                        }
                    } else {
                        echo "<td colspan=9>No hay Reuniones</td>";
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



                    $conn->close();
                    ?>
                </table>
            </form>
        </section>
</body>

</html>