<?php

/**
 *
 * @author Gabriel
 */
class Buzo
{

    private $_material = "";

    public function __construct($material)
    {
        $this->_material = $material;
    }

    public function __toString()
    {
        return __CLASS__;
    }

}

