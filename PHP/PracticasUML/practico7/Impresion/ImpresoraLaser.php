<?php

require_once 'interfaces/Escritor.php';

class ImpresoraLaser implements Escritor
{

    public function escribir($texto)
    {
        echo "Imprimo con laser: ".$texto;
    }

}