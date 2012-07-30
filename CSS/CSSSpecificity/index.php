<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Testing prioridades CSS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Estilos -->
<link rel="stylesheet" href="hoja1.css" type="text/css" media="screen" />
<link rel="stylesheet" href="hoja2.css" type="text/css" media="screen" />
<style>

#parrafo { color:#f00; }
.parrafo { color:#0f0; }

#link { color: #f00; }
.link { color: #0f0 !important; }

#contenedor a { color: #639; }
.contenedor a { color: #639; }

</style>
<!-- /Estilos -->

</head>

<body>

<h1>Testing prioridades CSS</h1>
<div style="padding:20px; font-size: 10px;"><?php include('LEAME.TXT'); ?></div>


<!-- Sin important -->
<h2>Testing con parrafos (sin usar important)</h2>
<p>Parrafo con <b>ELEMENT</b> (Ambas hojas de estilo declaran un color por defecto para parrafos pero obtiene el color de la segunda porque es la última declarada)</p>
<p class="parrafo">Parrafo solo con <b>CLASS</b> (CLASS tiene mas prioridad que element)</p>
<p id="parrafo" class="parrafo">Parrafo con <b>ID</b> y CLASS (ID tiene mas prioridad que CLASS)</p>
<p id="parrafo" class="parrafo" style="color:#00f;">Parrafo con ID , CLASS e <b>INLINE</b> (INLINE tiene mas prioridad que todos)</p>
<!-- /Sin important -->

<br />

<!-- Con important -->
<h2>Testing con links (usando important)</h2>
<a href="#" id="link" class="link">Link con ID y CLASS (class tiene important y por lo tanto adquiere mayor prioridad)</a><br />
<a href="#" id="link" class="link" style="color:#00f;">Link con ID, CLASS y INLINE (class tiene important y adquiere mayor prioridad incluso con inline)</a><br />
<!-- /Con important -->


<br />

<h2>Testing de "especificidad"</h2>

<style>
	ul#demo li {color: #000;}
	.resaltado {color: red; font-weight: bold;}
	#resaltado {color: red;  }
</style>

<ul id="demo">
    <li id="resaltado" class="resaltado" style="color: red;">primer item de una lista</li>
    <li>segundo item de una lista</li>
    <li>tercer item de una lista</li>
    <li>cuarto item de una lista</li>
</ul>



</body>
</html>