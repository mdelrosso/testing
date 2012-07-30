<?php 

// Testeo de clases abstractas
abstract class Persona 
{
    
    private $nombre = null;
    private $apellido = null;
    
    abstract public function getNombre();
    abstract public function getApellido();
    abstract public static function getId();
}

class Cliente extends Persona 
{
    public function getNombre() 
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public static function getId() 
    {
        return 1;
    }
}


$mariano = new Cliente();


?>