<?php

require_once 'DiscoDuro.php';

/**
 *
 * @author Gabriel
 */
class Sistema
{

    private $_discosDuros = array();

    public function addDiscoDuro(DiscoDuro $discoDuro)
    {
        $this->_discosDuros[] = $discoDuro;
    }

    public function buscar($nombreUnidad, $elemento)
    {

        foreach ($this->_discosDuros as $k => $disco) {
            if ($disco->getNombreUnidad() == $nombreUnidad) {
                return $disco->buscar($elemento);
            }
        }

        return NULL;
    }

}

?>
