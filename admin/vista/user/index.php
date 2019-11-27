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
    <title>Sistema de Gestion Reuniones</title>
    <script type="text/javascript" src="ajax.js"></script>
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
                <li><a href="nueva_reunion.php?codigo=<?php echo $codigo ?>">Nueva reunion</a></li>
                <li><a href="micuenta.php?codigo=<?php echo $codigo ?>">Mi cuenta</a></li>
                <li><a href="../../../config/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <section class="info">
            <?php
            $sqli = "SELECT usu_imagen,usu_nombres,usu_apellidos FROM usuario WHERE usu_codigo='$codigo'";
            $stm = $conn->query($sqli);

            ?>
        </section>

        <section class="mensajes">
            <h3>Reuniones</h3>
            <form id="form_mensajes"><input type="text" id="buscarMotivo" name="buscarMotivo" value="" onkeyup="buscarC(<?php echo $codigo ?>)" placeholder="Buscar por motivo...">
                <div id="informacion">
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


                        $sql = "SELECT * FROM reunion WHERE reu_usu_destino='$codigo' OR  reu_usu_remite='$codigo'  ORDER BY reu_fecha_encuentro";
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
                            echo "<td colspan=8>No tiene reuniones</td>";
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
                </div>
            </form>
        </section>
</body>

</html>