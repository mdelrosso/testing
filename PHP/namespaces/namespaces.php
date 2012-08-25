<?php
echo '<h1>Test of namespaces</h1>';

require('global.php');
require('namespace1.php');
require('namespace2.php');
require('namespace3.php');

?>

<style>

.global { color: #f4f;}
.ns1 { color: #f00;}
.ns2 { color: #0f0;}
.ns3 { color: #00f;}

</style>


<?php 
echo '<h2>con FQN</h2>';
echo '<code>ns1\funcion();</code>'; ns1\funcion();

echo '<br/>';
echo '<code>ns2\funcion2();</code>'; ns2\funcion();

echo '<br/>';
echo '<code>ns3\funcion();</code>'; ns3\funcion();


echo '<h2>con USE</h2>';

echo '<code>

use ns1; <br/>
ns1\funcion(); // Ejecuta la funcion correcta <br/>
funcion(); // Ejecuta la funcion global <br/>

</code>'; 
use ns1;
ns1\funcion();
funcion();

echo '<br/>';
echo '<code>
use ns2\funcion; <br/> 
ns2\funcion(); // Ejecuta la funcion correcta <br/>
funcion(); // Ejecuta la funcion global igualmente porque el USE + FQN solo funciona con clases (Como se ve en el siguiente ejemplo) <br/>
</code>'; 
use ns2\funcion;
ns2\funcion();
funcion();

echo '<br/>';
echo '<code>
use ns2\clase; <br/> 
$a = new clase(); // Instancia la clase correcta <br/>
$a = new ns2\clase(); // Tambien instancia la clase correcta <br/>
</code>'; 
use ns2\clase;
$a = new clase();
$a = new ns2\clase();


?>