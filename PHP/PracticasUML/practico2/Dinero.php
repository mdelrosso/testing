<?php

/**
 *
 * @author Gabriel
 * 
 */
class Dinero
{

    private $_monto = 0.00;
    private $_moneda = "";

    public function __construct($monto, $moneda)
    {
        $this->_monto = $monto;
        $this->_moneda = $moneda;
    }

    public function __toString()
    {
        return $this->_monto." ".$this->_moneda;
    }

}
