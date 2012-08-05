<?php

/**
 * Representa un LenguajeProgramacion
 *
 * @author Gabriel
 */
class LenguajeProgramacion
{

    private $_nombre = "";

    public function __construct($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function __toString()
    {
        return $this->_nombre;
    }

}
