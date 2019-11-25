<?php
    include '../../../config/conexionBD.php';
    $codigo = $_POST["codigo"];
    $destino = isset($_POST["destino"]) ? trim($_POST["destino"]) : null;
    $asunto = isset($_POST["asunto"]) ? mb_strtoupper(trim($_POST["asunto"]), 'UTF-8') : null;
    $mensaje = isset($_POST["mensaje"]) ? mb_strtoupper(trim($_POST["mensaje"]), 'UTF-8') : null;

    $codigo_destino;

    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d H:i:s',time());

    $sql = "SELECT usu_codigo FROM usuario WHERE usu_correo='$destino'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $codigo_destino=$row["usu_codigo"];
        }
    }else{
        echo "No existen usuarios registrados en el sistema";
    }
    echo $codigo_destino;

    $sql1 = "INSERT INTO correo VALUES (0, '$codigo', '$codigo_destino', '$asunto', '$mensaje', null, 'N', null, null);";
    if ($conn->query($sql1)==FALSE){
        echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
    }
    $conn->close();

    header("Location: ../../vista/user/index.php?codigo=".$codigo);
?>