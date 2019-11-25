<?php

    include '../../../config/conexionBD.php';
    echo $codigo = $_GET["codigo"];

    $nombre = $_FILES['txtImg']['name'];
    $tmp = $_FILES['txtImg']['tmp_name'];
    $folder = 'imagenes';
    move_uploaded_file($tmp,'../../../'.$folder.'/'.$nombre);

    $bytesArchivo = file_get_contents('../../../'.$folder.'/'.$nombre);

    $sql = "UPDATE usuario SET usu_imagen=? WHERE usu_codigo=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss',$bytesArchivo,$codigo);
    if($stm->execute()){
        echo 'Insertado con exito :)';
    }else{
        echo 'Error';
    }

    header("Location: ../../vista/user/index.php?codigo=".$codigo);
?>