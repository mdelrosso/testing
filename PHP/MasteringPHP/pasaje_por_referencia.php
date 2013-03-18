<?php

/// ----- Paso de par�metros por referencia -----
echo '*** Paso de par�metros por referencia *** <br/>';


function aumentar(&$numero) {
    $numero++;
}

// no se define en la funci�n por lo cual al llamarla hay que poner & en el par�metro
function aumentar2($numero) {
    $numero++;
}

// Defino la variable
$numero = 1;

// Imprimo el valor original
echo $numero.'<br/>';

// aumento en uno usando recepci�n de valores por referencia (en la funcion)    
aumentar($numero);
echo $numero.'<br/>';

// Aumento en uno usando pasaje de par�metros por referencia (en la llamada)    
aumentar2(&$numero);
echo $numero.'<br/>';

// Lo mismo que antes pero con doble referencia
$num = &$numero;

aumentar($num);
echo $numero.'<br/>';

aumentar2(&$num);
echo $numero.'<br/>';