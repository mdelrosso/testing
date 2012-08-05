<?php

require_once 'LenguajeProgramacion.php';

/**
 * Representa un Desarrollador
 *
 * @author Gabriel
 */
class Desarrollador
{

    private $_nombre = "";

    /* colecciones */
    private $_colLenguajes = array();

    public function __construct($nombre)
    {
        $this->_nombre = $nombre;
    }
    
    /**
     * Devuelve el nombre del desarrollador
     * 
     * @return string 
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * Devuelve en un array LenguajeProgramacion
     * 
     * @return array
     */
    public function getLenguajesQueConoce()
    {
        return $this->_colLenguajes;
    }

    /**
     * Agrega un lenguaje a la coleccion de lenguajes
     * 
     * @param LenguajeProgramacion $lenguajeProgramacion 
     * 
     */
    private function agregarLenguaje(LenguajeProgramacion $lenguajeProgramacion)
    {
        $this->_colLenguajes[] = $lenguajeProgramacion;
    }

    /**
     * Agrega LenguajeProgramacion PHP5 al desarrollador
     * 
     * @return \Desarrollador $this (chain)
     * 
     */
    public function aprenderPhp5()
    {
        $this->agregarLenguaje(new LenguajeProgramacion("PHP5"));
        return $this;
    }

    /**
     * Agrega LenguajeProgramacion Zend Framework al desarrollador
     * 
     * @return \Desarrollador $this (chain)
     * 
     */
    public function aprenderZendFramework()
    {
        $this->agregarLenguaje(new LenguajeProgramacion("Zend Framework"));
        return $this;
    }

    public function __toString()
    {
        return $this->_nombre;
    }

}
