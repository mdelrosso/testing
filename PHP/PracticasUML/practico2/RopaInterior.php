<?php

/**
 *
 * @author Gabriel
 */
class RopaInterior
{

    private $_tipo = "";

    public function __construct($tipo)
    {
        $this->_tipo = $tipo;
    }

    public function __toString()
    {
        return __CLASS__;
    }

}
