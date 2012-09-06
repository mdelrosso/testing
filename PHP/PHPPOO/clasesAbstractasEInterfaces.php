<?php 

// Testeo de clases abstractas en conjunto con interfaces

// Declaro interfaz 
interface organismo {

    public function comer();
    

}

/** 
 * A pesar de decir que implementa la interfaz en realidad no lo hace pero 
 * obliga a sus hijas a que si lo hagan
 * La unica restriccion es que no puede declarar ese mismo metodo como abstracto
 */ 
abstract class Ser implements organismo
{
    // Este metodo debe ser declarado en las clases hijas
    abstract public function getNombre();
    
    /** 
     * Aca no puede declararse el metodo comer() como abstracto 
     * porque seria como declarar 2 abstracciones Una de la interfaz y la otra de la clase abstracta
     */
    //abstract public function comer();
}

class Persona extends Ser 
{
    public function getNombre() 
    {
        return 'Mariano';
    }
    
    public function comer() {}
    
    
}


class Perro extends Ser {
 
 
    public function getNombre() 
    {
        return 'Fufy';
    }
    
    
    public function comer(){}
    
}

echo 'Si no muestra ningun error entonces el ejemplo funcionó correctamente';





?>