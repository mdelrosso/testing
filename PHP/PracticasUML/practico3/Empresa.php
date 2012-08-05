<?php

require_once 'GerenteSistemas.php';
require_once 'Desarrollador.php';
require_once 'Proyecto.php';

/**
 * Representa una Empresa
 *
 * @author Gabriel
 */
class Empresa
{

    private $_nombre;

    /* colecciones */
    private $_colGerentesSistema = array();
    private $_colDesarrolladores = array();
    private $_colProyectos = array();

    public function __construct($nombre)
    {
        $this->_nombre = $nombre;
    }

    /**
     * Devuelve todos los proyectos de la empresa
     * 
     * @return array 
     *       
     */
    public function getAllProyectos()
    {
        return $this->_colProyectos;
    }

    /**
     * Devuelve todos los proyectos en los que esta involucrado un desarrollador
     * 
     * @param Desarrollador $desarrollador
     * 
     * @return array
     */    
    public function buscarProyectosDesarrollador($nombreDesarrollador)
    {
        $arrayAux = array();
        foreach ($this->_colProyectos as $k => $proyecto) {
            if ($proyecto->buscarDesarrollador($nombreDesarrollador) != null) {
                $arrayAux[] = $proyecto;
            }
        }

        return $arrayAux;
    }

    /**
     * Devuelve el proyecto por nombre
     * 
     * @param string $nombreProyecto
     * 
     * @return Proyecto 
     */
    public function buscarProyecto($nombreProyecto)
    {
        foreach ($this->_colProyectos as $k => $proyecto) {
            if ($proyecto->getNombre() == $nombreProyecto) {
                return $proyecto;
            }
        }

        return null;
    }

    /**
     * Devuelve los desarrolladores pertenecientes a un proyecto de la empresa
     * 
     * @param string $nombreProyecto nombre del proyecto
     * 
     * @return array 
     *      
     */
    public function buscarDesarrolladoresProyecto($nombreProyecto)
    {
        foreach ($this->_colProyectos as $k => $proyecto) {
            if ($proyecto->getNombre() == $nombreProyecto) {
                return $proyecto->getAllDesarrolladores();
            }
        }

        return null;
    }

    /**
     * Devuelve un desarrollador dentro de la Empresa por nombre
     * 
     * @param string $nombreDesarrollador nombre del desarrollador
     * 
     * @return Desarrollador
     */
    public function buscarDesarrollador($nombreDesarrollador)
    {
        foreach ($this->_colDesarrolladores as $k => $desarrollador) {
            if ($desarrollador->getNombre() == $nombreDesarrollador) {
                return $desarrollador;
            }
        }

        return null;
    }

    /**
     * Agrega un Desarrollador a la coleccion
     * 
     * @param Desarrollador $desarrollador 
     */
    public function agregarDesarrollador(Desarrollador $desarrollador)
    {
        $this->_colDesarrolladores[] = $desarrollador;
    }

    /**
     * Agrega un GerenteSistemas a la coleccion
     * 
     * @param GerenteSistemas $gerenteSistemas 
     */
    public function agregarGerenteSistemas(GerenteSistemas $gerenteSistemas)
    {
        $this->_colGerentesSistema[] = $gerenteSistemas;
    }

    /**
     * Agrega un Proyecto a la coleccion
     * 
     * @param Proyecto $proyecto 
     */
    public function agregarProyecto(Proyecto $proyecto)
    {
        $this->_colProyectos[] = $proyecto;
    }

    /**
     * Asigna un desarrollador a un proyecto de la empresa
     * 
     * @param Desarrollador $desarrollador
     * @param Proyecto $proyecto 
     * 
     * @throws Exception si el proyecto o el desarrollador no existen en la empresa
     */
    public function asignarDesarrolladorAProyecto(Desarrollador $desarrollador, Proyecto $proyecto)
    {
        if (!$this->_existeDesarrollador($desarrollador)) {
            throw new Exception("El desarrollador $desarrollador no trabaja en esta empresa");
        }

        if (!$this->_existeProyecto($proyecto)) {
            throw new Exception("El proyecto $proyecto no existe en esta empresa");
        }

        $proyecto->asignarDesarrollador($desarrollador);
    }

    /**
     * Asigna un GerenteSistemas a un proyecto de la empresa
     * 
     * @param GerenteSistemas $gerente
     * @param Proyecto $proyecto
     * 
     * @throws Exception si el proyecto o el gerente no existen en la empresa
     */
    public function asignarGerenteSistemasAProyecto(GerenteSistemas $gerente, Proyecto $proyecto)
    {
        if (!$this->_existeGerenteSistemas($gerente)) {
            throw new Exception("El gerente de sistemas $gerente no trabaja en esta empresa");
        }

        if (!$this->_existeProyecto($proyecto)) {
            throw new Exception("El proyecto $proyecto no existe en esta empresa");
        }

        $proyecto->asignarGerenteSistemas($gerente);
    }

    
    /**
     * Devuelve si existe el Desarrollador en la Empresa
     * 
     * @param Desarrollador $desarrollador
     * @return boolean 
     */
    private function _existeDesarrollador(Desarrollador $desarrollador)
    {
        foreach ($this->_colDesarrolladores as $k => $v) {
            if ($v->getNombre() == $desarrollador->getNombre()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Devuelve si existe el Proyecto en la Empresa
     * 
     * @param Proyecto $proyecto
     * @return boolean 
     */
    private function _existeProyecto(Proyecto $proyecto)
    {
        foreach ($this->_colProyectos as $k => $v) {
            if ($v->getNombre() == $proyecto->getNombre()) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Devuelve si existe el GerenteSistemas en la empresa
     * 
     * @param GerenteSistemas $gerente
     * @return boolean
     */
    private function _existeGerenteSistemas(GerenteSistemas $gerente)
    {
        foreach ($this->_colGerentesSistema as $k => $v) {
            if ($v->getNombre() == $gerente->getNombre()) {
                return true;
            }
        }
        return false;
    }

    public function __toString()
    {
        return $this->_nombre;
    }

}
