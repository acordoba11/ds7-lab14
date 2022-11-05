<?php
session_start();

if( isset($_REQUEST['usuario']) && isset($_REQUEST['clave']) ) {
    $usuario = $_REQUEST['usuario'];
    $clave = $_REQUEST['clave'];

    $salt = substr($usuario, 0, 2);
    $clave_crypt = crypt($clave, $salt);

    require_once("class/usuario.php");

    $obj_usuario = new usuario();
    $usuario_validado = $obj_usuario->validar_usuario($usuario, $clave_crypt);

    foreach($usuario_validado as $array_resp) {
        foreach($array_resp as $value) {
            $nfilas = $value;
        }
    }

    if( $nfilas > 0 ) {
        $usuario_valido = $usuario;
        $_SESSION["usuario_valido"] = $usuario_valido;
    }
}
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
    ?>

    <h1>Gestión de noticias</h1>
    <hr>
    <ul>
        <li><a href="lab142.php">Listar todas las noticias</a></li>
        <li><a href="lab143.php">Listar noticias por partes</a></li>
        <li><a href="lab144.php">Buscar noticia</a></li>
    </ul>
    <hr>
    <p>[ <a href="logout.php">Cerrar sesión</a> ]</p>

    <?php
    } 
    // Intento de entrada fallido
    elseif( isset($usuario) ) {
        print("<br><br>\n");
        print("<p align='center'>Acceso no autorizado</p>\n");
        print("<p align='center'>[ <a href='login.php'>Iniciar sesión</a> ]</p>\n");
    }
    // Sesión no iniciada ni usuario ingresado
    else {
        print("<br><br>\n");
        print("<p class='parrafocentrado'>Esta zona tiene el acceso restringido.<br> "."Para entrar, debe identificarse.</p>\n");

        print("<form class='entrada' name='login' action='login.php' method='post'>\n");
        print("<p><label class='etiqueta-entrada'>Usuario:</label>\n");
        print("<input type='text' name='usuario' size='15'></p>\n");
        print("<p><label class='etiqueta-entrada'>Clave:</label>\n");
        print("<input type='password' name='clave' size='15'></p>\n");
        print("<input type='submit' value='Entrar'></p>\n");
        print("</form>\n");

        print("<p class='parrafocentrado'>NOTA: si no dispone de identificación o tiene problemas para entrar<br>póngase en contacto con el <a href='mailto:webmaster@localhost'>administrador</a> del sitio</p>\n");
    }
    ?>
    
</body>
</html>