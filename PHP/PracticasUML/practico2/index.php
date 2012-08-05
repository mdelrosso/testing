<?php

require_once 'Mueble.php';
require_once 'Cajon.php';
require_once 'Cofre.php';

require_once 'Media.php';
require_once 'RopaInterior.php';
require_once 'Buzo.php';
require_once 'Camisa.php';
require_once 'Dinero.php';

/**
 *  
 * @author Gabriel
 */
class Index
{

    public static function main()
    {
        //Creamos el Mueble
        $mueble = new Mueble();

        //Creamos 4 Cajones
        $cajon1 = new Cajon();
        $cajon2 = new Cajon();
        $cajon3 = new Cajon();
        $cajon4 = new Cajon();

        //Creamos dos pares de Medias
        $mediaDeColor1 = new Media("Azul");
        $mediaDeColor2 = new Media("Blanco");

        //Creamos Ropa interior
        $ropaInteriorUnisex1 = new RopaInterior("Hombre");
        $ropaInteriorUnisex2 = new RopaInterior("Mujer");

        //Creamos Buzos
        $buzoLana1 = new Buzo("Lana");
        $buzoLana2 = new Buzo("Lana");

        //Creamos Camisas
        $camisa1 = new Camisa();
        $camisa2 = new Camisa();

        //Guardamos las cosas
        $cajon1->guardar($mediaDeColor1);
        $cajon1->guardar($mediaDeColor2);

        $cajon2->guardar($ropaInteriorUnisex1);
        $cajon2->guardar($ropaInteriorUnisex2);

        $cajon3->guardar($buzoLana1);
        $cajon3->guardar($buzoLana2);

        $cajon4->guardar($camisa1);
        $cajon4->guardar($camisa2);

        //Creamos el Cofre y el Dinero ahorro
        $cofre = new Cofre();
        $dinero = new Dinero(100, "dolares");

        //Guardamos el dinero dentro del cofre
        $cofre->guardar($dinero);

        //Guardamos el cofre en un cajon        
        $cajon3->guardar($cofre);

        //Ponemos los cajones en el mueble
        $mueble->agregarCajon($cajon1);
        $mueble->agregarCajon($cajon2);
        $mueble->agregarCajon($cajon3);
        $mueble->agregarCajon($cajon4);

        echo "<pre>";
        print_r($mueble);
        echo "<pre>";
    }

}

Index::main();

