<?php 

// Testeo de clases con metodos estáticos

class Auto {
    
    private static $modelo = 'Linea';
    private $motor = '1.6';

    public static function getMarca() 
    {
        return 'Fiat';
    }

    public static function getMarcaModelo() 
    {
        return self::getMarca().' | '.self::$modelo;
    }

    public static function setModelo($newModelo)
    {
        self::$modelo = $newModelo;
    }

    public function getDatos() 
    {
        return self::getMarca().' | '.self::$modelo.' | '.$this->motor;
    }
    
    // Metodo estático que se usara como estático y como no estático
    public static function getModelo()
    {
        return self::$modelo;
    }


}
// La fabrica de autos Fiat fabrica todos modelos Linea
echo '<b>La Fabrica está fabricando: </b>';
echo Auto::getMarcaModelo();
echo '<br/>';
// Salida: La Fabrica está fabricando: Fiat | Linea

// Cualquier auto que se fabrique en este momento sale con el modelo actual
echo '<b>Se fabrica un nuevo auto: </b>';
$auto1 = new Auto();
echo $auto1->getDatos();
echo '<br/>';
// Salida: Se fabrica un nuevo auto: Fiat | Linea | 1.6

// En un momento decide empezar a fabricar todos modelos Uno
Auto::setModelo('Uno');
echo '<b>La Fabrica ahora está fabricando: </b>';
echo Auto::getMarcaModelo();
echo '<br/>';
// Salida: La Fabrica ahora está fabricando: Fiat | Uno

// Cualquier auto que se fabrique en este momento sale con el modelo actual
echo '<b>Se fabrica un nuevo auto: </b>';
$auto2 = new Auto();
echo $auto2->getDatos();
echo '<br/>';
// Salida: Se fabrica un nuevo auto: Fiat | Uno | 1.6

// La fabrica cambió de modelo en la mitad y como la propiedad es estática todos los objetos ahora muestran ese modelo
echo '<b>El auto fabricando al principio ahora tiene nuevos datos porque cambio el objeto original: </b>';
echo $auto1->getDatos();
echo '<br/>';
// Salida: El auto fabricando al principio ahora tiene nuevos datos porque cambio el objeto original: Fiat | Uno | 1.6

// Los metodos estático pueden llamarse tanto en una instancia como por separado
echo $auto1->getModelo().'<br/>';
echo Auto::getModelo().'<br/>';
// Salida: Fiat | Fiat
