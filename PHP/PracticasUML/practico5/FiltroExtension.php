<?php

class FiltroExtension implements CriterioFiltro
{

    private $_extension;

    public function __construct($extension)
    {
        $this->_extension = $extension;
    }

    public function esSeleccionable(Archivo $archivo)
    {
        $encontrado = false;

        if ($archivo->getExtension() == $this->_extension) {
            $encontrado = true;
        }

        return $encontrado;
    }

}
