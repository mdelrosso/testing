<?php

require_once 'Elemento.php';

/**
 *
 * @author Gabriel
 */
class Directorio extends Elemento
{

    private $_listaElementos;

    public function __construct($nombre)
    {
        parent::__construct($nombre);
    }

    public function agregar(Elemento $elemento)
    {
        $this->_listaElementos[] = $elemento;
    }

    public function getContenido()
    {
        return $this->_listaElementos;
    }

    public function buscar($nombre)
    {
        if ($this->getNombre() == $nombre) {
            return $this;
        }

        return null;
    }

}
