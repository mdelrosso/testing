<?php

require_once 'interfaces/Escritor.php';

class ImpresoraChorroTinta implements Escritor
{

    public function escribir($texto)
    {
        echo "Imprimo con chorro tinta: ".$texto;
    }

}