<?php

require_once 'FacturaFactory.php';

abstract class GestorFacturacion
{

    public static function getFacturaContenido($id)
    {        
        return FacturaFactory::getFactura($id)->armarFactura();
    }

}

