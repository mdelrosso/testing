<?php

/**
 * BaseDeDatos
 *
 */
require_once 'ManejadorBaseDeDatosInterface.php';
require_once 'Sql.php';

class BaseDeDatos
{

    /**
     *
     * @var ManejadorBaseDeDatos
     */
    private $_manejador;

    /**
     *
     * @param ManejadorBaseDeDatos $manejador
     */
    public function __construct(ManejadorBaseDeDatos $manejador)
    {
        
        $this->_manejador = $manejador;
        
    }

    /**
     * Obtiene un objeto de tipo Sql y posteriormente
     * retorna un array con los datos obtenidos
     *
     * @param Sql $sql
     * @return array datos obtenidos
     */
    public function ejecutar(Sql $sql)
    {
        $this->_manejador->conectar();

        $datos = $this->_manejador->traerDatos($sql);

        $this->_manejador->desconectar();

        return $datos;
    }

    public function insertar($tabla, $valores)
    {              
        
        $this->_manejador->conectar();
        
        $this->_manejador->insertar($tabla, $valores);
        
        $this->_manejador->desconectar();
    }

}