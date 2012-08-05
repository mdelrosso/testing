<?php

require_once 'Media.php';
require_once 'RopaInterior.php';
require_once 'Buzo.php';
require_once 'Camisa.php';
require_once 'Cofre.php';

/**
 *
 * @author Gabriel
 */
class Cajon
{
    private $_contenido = array();

    public function guardar($objeto)
    {
        $this->_contenido[] = $objeto;        
    }

}
