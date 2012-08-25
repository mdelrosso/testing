<?php
const constante = '<div class="global">Soy una constante de global!</div>';

class clase { 
    
    
    function __construct() {
        echo '<div class="global">Soy una clase de global!</div>';
    }
    
}

function funcion() { 
    echo '<div class="global">Soy una funcion de global!</div>';
}

