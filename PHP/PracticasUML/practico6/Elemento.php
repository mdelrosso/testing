<?php

/**
 *
 * @author Gabriel
 */
abstract class Elemento
{

    private $_nombre;

    public function __construct($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public abstract function buscar($nombre);

}
