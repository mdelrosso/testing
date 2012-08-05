<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class BaseDeDatos
{
    private $_manejador;

    public function __construct(ManejadorBaseDeDatosInterface $manejador)
    {
        $this->_manejador = $manejador;
    }
    public function ejecutar(Sql $sql)
    {
        $this->_manejador->conectar();

        $datos = $this->_manejador->traerDatos($sql);

        $this->_manejador->desconectar();

        return $datos;
    }
}
