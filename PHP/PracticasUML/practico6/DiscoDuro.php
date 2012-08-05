<?php

require_once 'Directorio.php';
require_once 'Archivo.php';

class DiscoDuro
{

    private $_nombreUnidad = "";
    private $_fileSystem = array();

    public function __construct($nombreUnidad)
    {
        $this->_nombreUnidad = $nombreUnidad;
    }

    public function getContenido()
    {
        return $this->_fileSystem;
    }

    public function getNombreUnidad()
    {
        return $this->_nombreUnidad;
    }

    public function buscar($nombreDirectorio, $lugar = NULL)
    {
        //si no se especifica un directorio dentro del DiscoDuro usamos el raiz
        $lugar = ($lugar == NULL) ? $this->_fileSystem : $lugar;

        $a = array();

        foreach ($lugar as $k => $elemento) {
            if ($elemento->buscar($nombreDirectorio) != NULL) {
                $a[] = $elemento;
            } else {

                if ($elemento instanceof Directorio and count($elemento->getContenido()) > 0) {
                    $result = $this->buscar($nombreDirectorio, $elemento->getContenido());
                    if (count($result) > 0) {
                        $a = array_merge($a, $result);
                    }
                }
            }
        }

        return $a;
    }

    public function addDirectorio($nombreDirectorioNuevo, $nombreDirectorioDestino)
    {
        $directorioNuevo = new Directorio($nombreDirectorioNuevo);

        if ($nombreDirectorioDestino == "/") {
            $this->_fileSystem[] = $directorioNuevo;
        } else {
            $directorioDondeSeGuardara = $this->buscar($nombreDirectorioDestino);
            $directorioDondeSeGuardara[0]->agregar($directorioNuevo);
        }
    }

    public function addArchivo($nombreArchivoNuevo, $nombreDirectorioDestino)
    {
        $archivoNuevo = new Archivo($nombreArchivoNuevo);

        if ($nombreDirectorioDestino == "/") {
            $this->_fileSystem[] = $archivoNuevo;
        } else {
            $directorioDondeSeGuardara = $this->buscar($nombreDirectorioDestino);
            $directorioDondeSeGuardara[0]->agregar($archivoNuevo);
        }
    }

}
