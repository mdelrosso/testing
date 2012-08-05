<?php

require_once 'GerenteSistemas.php';
require_once 'Desarrollador.php';

/**
 * Description of Proyecto
 *
 * @author Gabriel
 */
class Proyecto
{

    private $_fechaInicio;
    private $_fechaFin;
    private $_nombre;
    private $_gerenteSistemas;

    /* Colecciones */
    private $_colDesarrolladoresAsignados = array();

    public function __construct($fechaInicio, $fechaFin, $nombre)
    {
        $this->_fechaInicio = $fechaInicio;
        $this->_fechaFin = $fechaFin;
        $this->_nombre = $nombre;
    }

    /**
     * Devuelve el nombre del proyecto
     * 
     * @return string 
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * Devuelve todos los desarrolladores involucrados en el proyecto
     * 
     * @return array 
     */
    public function getAllDesarrolladores()
    {
        return $this->_colDesarrolladoresAsignados;
    }

    /**
     * Devuelve el gerente de sistemas del proyecto, en caso de no tener devuelve null
     * 
     * @return GerenteSistemas 
     */
    public function getGerenteSistemasACargo()
    {
        return ($this->_gerenteSistemas instanceof GerenteSistemas) ? $this->_gerenteSistemas : null;
    }

    /**
     * Devuelve el desarrollador por nombre
     * 
     * @param string $nombreDesarrollador
     * 
     * @return Desarrollador 
     */
    public function buscarDesarrollador($nombreDesarrollador = "")
    {
        foreach ($this->_colDesarrolladoresAsignados as $k => $desarrollador) {
            if ($desarrollador->getNombre() == $nombreDesarrollador) {
                return $desarrollador;
            }
        }

        return null;
    }

    /**
     * Asigna un gerente al proyecto
     * 
     * @param GerenteSistemas $gerente 
     */
    public function asignarGerenteSistemas(GerenteSistemas $gerente)
    {
        $this->_gerenteSistemas = $gerente;
    }

    /**
     * Asigna un desarrollador a la coleccion de desarrolladores del Proyecto
     * 
     * @param Desarrollador $desarrollador 
     */
    public function asignarDesarrollador(Desarrollador $desarrollador)
    {
        $this->_colDesarrolladoresAsignados[] = $desarrollador;
    }

    public function __toString()
    {
        return $this->_nombre;
    }

}
