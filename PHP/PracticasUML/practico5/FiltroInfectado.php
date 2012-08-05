<?php
require_once 'CriterioFiltro.php';

class FiltroInfectado implements CriterioFiltro
{

    private $_estaInfectado = 1;

    
    public function esSeleccionable(Archivo $archivo)
    {
        $encontrado = false;        
        if ($archivo->estaInfectado() == $this->_estaInfectado) {
            $encontrado = true;
        }

        return $encontrado;
    }

}
