<?php

require_once 'Dinero.php';

/**
 *
 * @author Gabriel
 */
class Cofre
{

    private $_contenido = array();

    public function guardar($objeto)
    {
        $this->_contenido[] = $objeto;
    }

    public function __toString()
    {
        return __CLASS__;
    }

}
