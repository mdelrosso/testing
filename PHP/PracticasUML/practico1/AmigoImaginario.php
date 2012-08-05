<?php

/**
 * @TODO: usar guion bajo para atributos privados segun standard zend
 *
 * @author Gabriel
 */
class AmigoImaginario
{

    private $nombre = "";
    private $tipoAnimal = "";
    private $dientes = 0;
    private $brazos = 0;
    private $color = "";
    private $habilidad = "";

    public function __construct($nombre, $tipoAnimal)
    {
        $this->nombre = $nombre;
        $this->tipoAnimal = $tipoAnimal;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setDientes($cantidad)
    {
        $this->dientes = $cantidad;
    }

    public function setBrazos($cantidad)
    {
        $this->brazos = $cantidad;
    }

    public function setHabilidad($habilidad)
    {
        $this->habilidad = $habilidad;
    }

    public function hacerMalabaresConPelota()
    {
        return "Estoy haciendo malabares";
    }

}

