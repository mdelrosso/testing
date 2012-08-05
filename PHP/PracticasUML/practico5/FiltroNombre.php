<?php

require_once 'CriterioFiltro.php';

class FiltroNombre implements CriterioFiltro
{

    private $_nombre;

    public function __construct($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function esSeleccionable(Archivo $archivo)
    {
        $encontrado = false;
        if ($archivo->getNombre() == $this->_nombre) {
            $encontrado = true;
        }

        return $encontrado;
    }

}
