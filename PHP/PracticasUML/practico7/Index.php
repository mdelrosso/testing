<?php

//Paquete documentacion
require_once 'documentacion/DocumentoFactory.php';

//Paquete impresion
require_once 'impresion/GestorImpresion.php';

//Paquete facturacion
require_once 'facturacion/GestorFacturacion.php';

abstract class Index
{

    public static function run()
    {
        GestorImpresion::imprimirConChorroTinta(DocumentoFactory::crearHtml(GestorFacturacion::getFacturaContenido(2)));
        GestorImpresion::imprimirConPdf(DocumentoFactory::crearHtml(GestorFacturacion::getFacturaContenido(1)));
    }

}

Index::run();