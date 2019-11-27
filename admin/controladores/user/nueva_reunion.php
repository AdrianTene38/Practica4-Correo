<?php
    include '../../../config/conexionBD.php';
    $codigo = $_POST["codigo"];
    $destino = isset($_POST["destino"]) ? trim($_POST["destino"]) : null;
    $motivo = isset($_POST["motivo"]) ? mb_strtoupper(trim($_POST["motivo"]), 'UTF-8') : null;
    $observacion = isset($_POST["observacion"]) ? mb_strtoupper(trim($_POST["observacion"]), 'UTF-8') : null;      
    $lugar = isset($_POST["lugar"]) ? mb_strtoupper(trim($_POST["lugar"]), 'UTF-8') : null;
    $latitud = ($_POST["latitud"]) ;  
    $longitud = ($_POST["longitud"]) ;
    $codigo_destino;
    date_default_timezone_set("America/Guayaquil");
    $fechaEncuentro = date("Y-m-d H:i:s",strtotime($_POST["fechaEncuentro"]));
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
    $sql1 = "INSERT INTO reunion VALUES (0, '$codigo', '$codigo_destino', '$motivo', '$observacion','$fechaEncuentro',
    '$lugar', '$latitud', '$longitud', 'N');";
    if ($conn->query($sql1)==FALSE){
        echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
    }
    $conn->close();
    header("Location: ../../vista/user/index.php?codigo=".$codigo);
?>

