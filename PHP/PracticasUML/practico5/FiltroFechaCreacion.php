<?php

class FiltroFechaCreacion implements CriterioFiltro
{

    private $_fecha;

    public function __construct($fecha)
    {
        $this->_fecha = $fecha;
    }

    public function esSeleccionable(Archivo $archivo)
    {

        $encontrado = false;
        if ($archivo->getFechaCreacion() == $this->_fecha) {
            $encontrado = true;
        }

        return $encontrado;
    }

}
