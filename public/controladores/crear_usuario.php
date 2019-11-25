<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Crear nuevo documento</title>
     <style type = "text/css" ref= "stylesheet">
     error{
         color: red;
     }
     </style>
 </head>
 <body>
    <?php
    include '../../config/conexionBD.php';

    $cedula = isset($_POST["cedula"]) ?trim($_POST["cedula"]): null;
    $nombres = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8'): null;
    $apellidos = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8'): null;
    $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8'): null;
    $telefono = isset($_POST["telefono"]) ? mb_strtoupper(trim($_POST["telefono"]), 'UTF-8'): null;
    $correo= isset($_POST["email"]) ? mb_strtoupper(trim($_POST["email"]), 'UTF-8'): null;
    $fD= isset($_POST["fD"]) ? mb_strtoupper(trim($_POST["fD"]), 'UTF-8'): null;
    $password= isset($_POST["password"]) ? mb_strtoupper(trim($_POST["password"]), 'UTF-8'): null;
    $sql = "INSERT INTO usuario VALUES (0, '$cedula', '$nombres', '$apellidos', '$direccion', '$telefono', '$correo', MD5('$password'), '$fD', 'N', null, null, 2, null)";

    if ($conn->query($sql)==TRUE){
        echo"<p>Se han creado los datos personales correctamente!!!</p>";
    }else{
        if ($conn->errno == 1062){
            echo"<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema</p>";
        }else{
            echo"<p class='error'>Error: " .mysqli_error($conn)."</p>";
        }
    }
    $conn->close();
    echo"<a href='../vista/crear_usuario.html'>Regresar</a>";
?>
 </body>
 </html>
