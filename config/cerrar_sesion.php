<?php
    session_start();
    $_SESSION['isLogged'] = FALSE;
    session_destroy();
    header("Location: /Practica4-Correo/public/vista/login.html");
?>