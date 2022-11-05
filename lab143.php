<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Laboratorio 11.1</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <h1>Consulta de noticias</h1>

    <?php
    if( isset($_SESSION['usuario_valido']) ) {
        require_once("class/noticias.php");

        $obj_noticia = new noticia();
        $np = 1;
        $rp = 5;

        if( array_key_exists('np', $_GET) & array_key_exists('rp', $_GET) ) {
            $np = $_GET["np"];
            $rp = $_GET["rp"];
        }

        $obj_noticia2 = new noticia();
        $total_noticias = $obj_noticia2->contar_registros()['0']['cantidad'];

        $noticias = $obj_noticia->paginar($np,$rp);
        $nfilas = count($noticias);

        $n_noticia_ini = ($np - 1) * $rp + 1;
        $n_noticia_fin = $n_noticia_ini + $rp - 1;

        $anchor_ant = "<a href='lab143.php?np=". $np - 1 ."&rp=".$rp."'>Anterior</a>";
        $anchor_sig = "<a href='lab143.php?np=". $np + 1 ."&rp=".$rp."'>Siguiente</a>";

        // Verificar si es la primera página
        if( $np == 1 ) {
            $anchor_ant = "<a>Anterior</a>";
        }
        // Verificar si es la última página
        if( $np-($total_noticias/$rp) >= 0 ) {
            $anchor_sig = "<a>Siguiente</a>";
            $n_noticia_fin = $n_noticia_ini + $nfilas - 1;
        }
        
        print("Mostrando noticias $n_noticia_ini a $n_noticia_fin de un total de $total_noticias.");
        print("   [ $anchor_ant | $anchor_sig ]");
        print("<br><br>");

        if($nfilas > 0) {
            print("<table>\n");
            print("<tr>\n");
            print("<th>Titulo</th>\n");
            print("<th>Texto</th>\n");
            print("<th>Categoria</th>\n");
            print("<th>Fecha</th>\n");
            print("<th>Imagen</th>\n");
            print("</tr>\n");

            foreach($noticias as $resultado) {
                print("<tr>\n");
                print("<td>" . $resultado['titulo'] . "</td>\n");
                print("<td>" . $resultado['texto'] . "</td>\n");
                print("<td>" . $resultado['categoria'] . "</td>\n");
                print("<td>" . date("j/n/Y",strtotime($resultado['fecha'])) . "</td>\n");

                if($resultado['imagen'] != "") {
                    print("<td><a target='_blank' href='img/".$resultado['imagen']."'><img border='0' src='img/iconotexto.gif'></a></td>\n");
                } else {
                    print("<td>&nbsp;</td>\n");
                }
                
                print("</tr>\n");
            }
            print("</table>\n");

            print("<p>[ <a href='login.php'>Menú principal</a> ]</p>");
        } else {
            print("No hay noticias disponibles");
        }
    } else {
        print("<br><br>\n");
        print("<p align='center'>Acceso no autorizado</p>\n");
        print("<p align='center'>[ <a href='login.php'>Iniciar sesión</a> ]</p>\n");
    }

    

    ?>
</body>
</html>