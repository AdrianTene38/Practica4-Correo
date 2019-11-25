<?php

session_start();
 include '../../config/conexionBD.php';
 $usuario = isset($_POST["email"]) ? trim($_POST["email"]) : null;
 $contrasena = isset($_POST["password"]) ? trim($_POST["password"]) : null;
 $sql = "SELECT rol_usu_codigo FROM usuario WHERE usu_correo = '$usuario' and usu_password = MD5('$contrasena')";
  $result = $conn->query($sql);
  $_SESSION['isLogged'] = TRUE;
  if ( $result != 1) {
    header("Location: ../../admin/vista/user/index.php?codigo=".$row['usu_codigo']);
  } else {
    header("Location: ../../admin/vista/admin/index.php?codigo_admin=".$row['usu_codigo']);
}
$conn->close();
?>