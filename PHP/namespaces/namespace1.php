<?php
namespace ns1 {

    const constante = '<div class="ns1">Soy una constante de ns1!</div>';

    class clase { 
        
        
        function __construct() {
            echo '<div class="ns1">Soy una clase de ns1!</div>';
        }
        
    }

    function funcion() { 
        echo '<div class="ns1">Soy una funcion de ns1!</div>';
    }

} // end of namespace
