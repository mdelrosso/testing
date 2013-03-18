<?php

// Forzado de tipos en argumentos 
// Solo funciona con clases o con cualquier otro tipo de php que se representado internamente por una array por ejemplo)

class MyClass {}

// El parametro $c no funciona
function prueba(MyClass $a, array $b, (int) $c) {
    /* ... */
}


$a = new MyClass;
$b = array(0,1,2);

prueba($a, $b);



