<?php

require_once('modelo.php');

class noticia extends modeloCredencialesBD {
    protected $titulo;
    protected $texto;
    protected $categoria;
    protected $fecha;
    protected $imagen;

    public function __construct() {
        parent::__construct();
    }

    public function consultar_noticias() {
        $instruccion = "CALL sp_listar_noticias()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado) {
            echo "Fallo al consultar las noticias";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function consultar_noticias_filtro($campo, $valor) {
        $instruccion = "CALL sp_listar_noticias_filtro('".$campo."','".$valor."')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado) {
            echo "Fallo al consultar las noticias";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function paginar($num_pag, $reg_pag) {
        $instruccion = "CALL sp_paginar('noticias','".$num_pag."','".$reg_pag."')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado) {
            echo "Fallo al consultar las noticias";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function contar_registros() {
        $instruccion = "CALL sp_contar_registros('noticias')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);

        if(!$resultado) {
            echo "Fallo al contar las noticias";
        } else {
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

}

?>