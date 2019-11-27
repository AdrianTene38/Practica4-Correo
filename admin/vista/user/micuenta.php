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
            <ul> <li><a href="index.php?codigo=<?php echo $codigo ?>">Inicio</a></li>
                <li><a href="nueva_reunion.php?codigo=<?php echo $codigo ?>">Nueva reunion</a></li>
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
        <table id="buzon">
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Fecha Nacimiento</th>
                <th>Modificar</th>
                <th>Cambiar contrasena</th>
            </tr>

            <?php
            include '../../../config/conexionBD.php';

            $sql = "SELECT * FROM usuario WHERE usu_codigo='$codigo'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["usu_eliminado"] != 'S') {
                        echo "<tr>";
                        echo "<td>" . $row["usu_cedula"] . "</td>";
                        echo "<td>" . $row["usu_nombres"] . "</td>";
                        echo "<td>" . $row["usu_apellidos"] . "</td>";
                        echo "<td>" . $row["usu_direccion"] . "</td>";
                        echo "<td>" . $row["usu_telefono"] . "</td>";
                        echo "<td>" . $row["usu_correo"] . "</td>";
                        echo "<td>" . $row["usu_fecha_nacimiento"] . "</td>";
                        echo "<td class='accion'><a href='modificar.php?codigo=" . $row['usu_codigo'] . "'>Modificar</a></td>";
                        echo "<td class='accion'><a href='cambiar_contrasena.php?codigo=" . $row['usu_codigo'] . "'>Cambiar contrasena</a></td>";
                    }
                }
            } else {
                echo "<tr>";
                echo "<td colspan='9'>No existen usuarios registrados en el sistema</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
</body>

</html>