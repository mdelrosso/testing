<?php 

// ----- Strings -----
// Prueba de comillas dobles y simples

// Prueba de comillas simples
$var = 'Hola mundo';
echo 'Esto es un string literal muy sencillo con un escapado \' y se puede ver que no interpreta \n ni tampoco $var';
echo '</br>';

// Prueba de comillas dobles
echo "Esto \n es un string entre comillas dobles y con saltos \n de \n linea \r\n";

// ----- Arrays -----
echo "<br/><br/>";

// Eliminar un item del array
echo "Prueba de arrays: </br>";
$a = array(0 => 'uno', 1 => 'dos', 2 => 'tres');
unset($a[1]);
var_dump($a);

echo "Borro el elemento del medio y reindexo el array</br>";

$a = array_values($a);
var_dump($a);

echo "<br/><br/>";

// Modificar valores directamente en el bucle en PHP 5
echo "Modificar valores del array al pasarlo como referencia a un bucle (PHP5)<br/>";
// PHP 5
$colors = array('amarillo','azul','blanco');
print_r($colors);
echo "<br/>";
foreach ($colors as &$color) {
    $color = strtoupper($color);
}
unset($color); /* se asegura de que escrituras subsiguientes a $color no modifiquen el último elemento del arrays */
print_r($colors);
echo "<br/>";

