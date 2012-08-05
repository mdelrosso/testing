<?php

require_once 'interfaces/Imprimible.php';
require_once 'interfaces/Escritor.php';

abstract class MaquinaDeImprimir
{

    static public function run(Imprimible $imprimible, Escritor $escritor)
    {
        $escritor->escribir($imprimible->imprimir()."<br />");
    }

}