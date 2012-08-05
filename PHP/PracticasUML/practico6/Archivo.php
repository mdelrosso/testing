<?php

require_once 'Elemento.php';

/**
 *
 * @author Gabriel
 */
class Archivo extends Elemento
{

    public function __construct($nombre)
    {
        parent::__construct($nombre);
    }

    public function buscar($nombre)
    {
        if ($this->getNombre() == $nombre) {
            return $this;
        }

        return null;
    }

}
