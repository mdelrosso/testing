<?php

// Testo de cosas básicas para PHP


// ----- Pasaje de parámetros variables -----
function foo()
{
    $númargs = func_num_args();
    echo "Cantidad de argumentos: $númargs <br/>";

	echo 'Argumentos obtenidos por separado con func_get_arg(0) 1 y 2: ';
	$args[0] = func_get_arg(0);
	$args[1] = func_get_arg(1);
	$args[2] = func_get_arg(2);

	print_r($args);
	echo '<br/>';

	$args = func_get_args();

	echo 'Argumentos obtenidos con func_get_args(): ';
	print_r($args);
	echo '<br/>';


}

echo "*** Testo de parámetros variables para una funcion *** <br/>";
echo "Paso a una funcion foo(1,2,3) definida sin parámetros un numero x de parámetros <br/>";
foo(1, 2, 3); 











