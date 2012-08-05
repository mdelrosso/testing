<?php

class Html extends Documento
{

    public function __construct($contenido)
    {
        
        $s = "<html><head><body>".$contenido."</body></head></html>";
        
        parent::__construct($s);
    }

}
