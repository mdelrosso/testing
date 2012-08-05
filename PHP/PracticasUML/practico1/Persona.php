<?php

/**
 * @TODO: usar guion bajo para atributos privados segun standard zend
 *
 * @author Gabriel
 */
class Persona
{

    private $nombre = "";
    private $edad = 0;

    public function __construct($nombre, $edad)
    {

        $this->nombre = $nombre;
        $this->edad = $edad;
    }

}

