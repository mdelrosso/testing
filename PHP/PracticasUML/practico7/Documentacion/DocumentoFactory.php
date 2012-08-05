<?php

require_once 'Documento.php';
require_once 'Html.php';
require_once 'Ascii.php';

abstract class DocumentoFactory
{

    static public function crearHtml($contenido)
    {
        return new Html($contenido);
    }

    static public function crearAscii($contenido)
    {
        return new Ascii($contenido);
    }

}
