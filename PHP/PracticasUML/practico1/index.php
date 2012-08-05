<?php

require_once 'Persona.php';
require_once 'AmigoImaginario.php';

/**
 *  
 * @author Gabriel
 */
class Index
{

    function __construct()
    {
        $persona = New Persona('Dora', 3);
        
        echo "<pre>";
        print_r($persona);
        echo "</pre>";
        
        $amigoImaginario = New AmigoImaginario('Elvis', 'pulpo');
        $amigoImaginario->setBrazos(8);
        $amigoImaginario->setColor('purpura');
        $amigoImaginario->setDientes(2);
        $amigoImaginario->setHabilidad('HaceMalabares');
        $amigoImaginario->hacerMalabaresConPelota();
        
        echo "<pre>";
        print_r($amigoImaginario);
        echo "</pre>";
    }

}

$index = new Index();

