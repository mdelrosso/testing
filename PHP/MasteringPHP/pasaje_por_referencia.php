<?php

/// ----- Paso de parámetros por referencia -----
echo '*** Paso de parámetros por referencia *** <br/>';


function aumentar(&$numero) {
    $numero++;
}

// no se define en la función por lo cual al llamarla hay que poner & en el parámetro
function aumentar2($numero) {
    $numero++;
}

// Defino la variable
$numero = 1;

// Imprimo el valor original
echo $numero.'<br/>';

// aumento en uno usando recepción de valores por referencia (en la funcion)    
aumentar($numero);
echo $numero.'<br/>';

// Aumento en uno usando pasaje de parámetros por referencia (en la llamada)    
aumentar2(&$numero);
echo $numero.'<br/>';

// Lo mismo que antes pero con doble referencia
$num = &$numero;

aumentar($num);
echo $numero.'<br/>';

aumentar2(&$num);
echo $numero.'<br/>';