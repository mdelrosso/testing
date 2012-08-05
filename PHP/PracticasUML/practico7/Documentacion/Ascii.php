<?php

class Ascii extends Documento
{

    public function __construct($contenido)
    {

        $ascii = NULL;

        for ($i = 0; $i < strlen($contenido); $i++) {
            $ascii += ord($contenido[$i]);
        }


        parent::__construct($ascii);
    }

}
