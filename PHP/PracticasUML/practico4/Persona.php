<?php

/**
 *
 * @author Gabriel
 */
abstract class Persona
{

    private $nombre;
    private $apellido;
    private $mail;

    public function __construct($nombre, $apellido, $mail)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getMail()
    {
        return $this->mail;
    }

}

