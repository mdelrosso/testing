<?php
/* Este espacio de nombres tiene conflictos con el ns1 */
namespace ns3 {

    const constante = '<div class="ns3">Soy una constante de ns3!</div>';

    class clase { 
        
        
        function __construct() {
            echo '<div class="ns3">Soy una clase de ns3!</div>';
        }
        
    }

    function funcion() { 
        echo '<div class="ns3">Soy una funcion de ns3!</div>';
    }

} // end of namespace
