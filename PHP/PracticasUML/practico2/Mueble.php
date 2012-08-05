<?php
require_once 'Cajon.php';

/**
 *
 * @author Gabriel
 */
class Mueble
{
    
    private $_colCajones = array();
    
    public function agregarCajon(Cajon $cajon){
        $this->_colCajones[] = $cajon;
    }
    
}