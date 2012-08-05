<?php

class Archivo
{

    private $_nombre;
    private $_fecha;
    private $_tipo;
    private $_contenido = array();
    private $_infectado = 0;

    public function __construct($nombre, $fecha, $tipo, $infectado = false)
    {
        $this->_nombre = $nombre;
        $this->_fecha = $fecha;
        $this->_tipo = $tipo;
        $this->_infectado = $infectado;
    }

    public function getFechaCreacion()
    {
        return $this->_fecha;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function getContenido()
    {
        return $this->_contenido;
    }

    public function getExtension()
    {
        return end(explode('.', $this->_nombre));
    }

    public function guardar(Archivo $archivo)
    {
        if ($this->_tipo == 'DIR') {
            $this->_contenido[] = $archivo;
        }
    }

    public function estaInfectado()
    {
        return ($this->_infectado) ? true : false;
    }

    public function isDir()
    {
        return ($this->_tipo == 'DIR') ? true : false;
    }    

}
