<?php

require_once 'MaquinaDeImprimir.php';

require_once 'ImpresoraChorroTinta.php';
require_once 'ImpresoraLaser.php';
require_once 'ImpresoraPdf.php';

abstract class GestorImpresion
{

    public static function imprimirConChorroTinta(Imprimible $imprimible)
    {
        MaquinaDeImprimir::run($imprimible, new ImpresoraChorroTinta());
    }

    public static function imprimirConLaser(Imprimible $imprimible)
    {
        MaquinaDeImprimir::run($imprimible, new ImpresoraLaser());
    }
    
    public static function imprimirConPdf(Imprimible $imprimible)
    {
        MaquinaDeImprimir::run($imprimible, new ImpresoraPdf());
    }

}
