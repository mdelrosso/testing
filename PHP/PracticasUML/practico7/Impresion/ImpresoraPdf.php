<?php

class ImpresoraPdf implements Escritor
{

    public function escribir($texto)
    {
       echo "Imprimo pdf: ".$texto;
    }

}
