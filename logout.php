<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Laboratorio 14 - Login al sitio de Noticias</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <?php
    // Sesión iniciada
    if (isset($_SESSION["usuario_valido"])) {
        session_destroy();
        print("<br><br><p align='center'>Conexión finalizada</p>\n");
    } else {
        print("<br><br><p align='center'>No existe una conexión activa</p>\n");
    }
    print("<p align='center'>[ <a href='login.php'>Iniciar sesión</a> ]</p>\n");
    ?>
</body>
</html>