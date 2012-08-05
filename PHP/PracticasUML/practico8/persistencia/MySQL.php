<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'ManejadorBaseDeDatosInterface.php';

class MySQL implements ManejadorBaseDeDatosInterface
{
    const USUARIO = 'root';
    const CLAVE = '';
    const BASE = 'practico8';
    const SERVIDOR = 'localhost';

    private $_conexion;

    public function conectar()
    {
        $this->_conexion = mysql_connect(
            self::SERVIDOR,
            self::USUARIO,
            self::CLAVE
        );
        
        mysql_select_db(
            self::BASE,
            $this->_conexion
        );
    }
    public function desconectar()
    {
        mysql_close($this->_conexion);
    }
    public function traerDatos(SQL $sql)
    {
        echo DEBUG ? $sql : null;
        
        $resultado = mysql_query($sql, $this->_conexion);
        
        while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $todo[] = $fila;
        }
        return $todo;
    }
}