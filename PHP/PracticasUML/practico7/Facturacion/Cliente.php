<?php

class Cliente
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

}
