<?php

require_once 'Archivo.php';
require_once 'FiltroNombre.php';
require_once 'FiltroExtension.php';
require_once 'FiltroFechaCreacion.php';
require_once 'FiltroInfectado.php';

class DiscoDuro
{

    private $_fileSystem = array();

    /**
     * Busca un archivo en el disco duro recursivamente
     * 
     * @param array $lugar contenido directorio donde buscar
     * @param CriterioFiltro $filtro
     * @return type Archivo
     */
    private function buscar($lugar, CriterioFiltro $filtro)
    {
        $a = array();

        foreach ($lugar as $k => $archivo) {

            if ($filtro->esSeleccionable($archivo)) {
                $a[] = $archivo;
            } else {
                if ($archivo->isDir() and count($archivo->getContenido()) > 0) {
                    $result = $this->buscar($archivo->getContenido(), $filtro);
                    if (count($result) > 0) {
                        $a = array_merge($a, $result);
                    }
                }
            }
        }

        return $a;
    }

    /**
     * Agrega un archivo al disco duro
     * 
     * @param string $nombre
     * @param string $fechaCreacion
     * @param string $tipo DIR si es un directorio FILE si es un archivo
     * @param type $directorioDestinoNombre directorio nombre donde se guardara, en caso de guardar en root colocar "/"
     * @param type $infectado  si el archivo esta infectado
     * 
     */
    public function agregarArchivo($nombre, $fechaCreacion, $tipo, $directorioDestinoNombre, $infectado = false)
    {
        $archivo = new Archivo($nombre, $fechaCreacion, $tipo, $infectado);

        if ($directorioDestinoNombre == "/") {
            $this->_fileSystem[] = $archivo;
        } else {
            $filtroNombre = new FiltroNombre($directorioDestinoNombre);
            $archivoDondeSeGuarda = $this->buscar($this->_fileSystem, $filtroNombre);
            $archivoDondeSeGuarda[0]->guardar($archivo);
        }
    }

    public function buscarPorExtension($extension)
    {
        $filtroExtension = new FiltroExtension($extension);

        return $this->buscar($this->_fileSystem, $filtroExtension);
    }

    public function buscarPorNombre($nombre)
    {
        $filtroNombre = new FiltroNombre($nombre);

        return $this->buscar($this->_fileSystem, $filtroNombre);
    }

    public function buscarPorFechaCreacion($fecha)
    {
        $filtroFecha = new FiltroFechaCreacion($fecha);

        return $this->buscar($this->_fileSystem, $filtroFecha);
    }

    public function buscarPorInfectados()
    {
        $filtroInfectado = new FiltroInfectado();

        return $this->buscar($this->_fileSystem, $filtroInfectado);
    }   
        
}
