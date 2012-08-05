<?php

/**
 *
 * @author Gabriel
 */
class Media
{

    private $_color = "";

    public function __construct($color)
    {
        $this->_color = $color;
    }

    public function __toString()
    {
        return __CLASS__;
    }

}
