<?php

require_once 'interfaces/Imprimible.php';

abstract class Documento implements Imprimible
{

    private $_contenido = "";

    public function __construct($contenido)
    {
        $this->_contenido = $contenido;
    }

    public function imprimir()
    {
        return $this->_contenido;
    }

}
