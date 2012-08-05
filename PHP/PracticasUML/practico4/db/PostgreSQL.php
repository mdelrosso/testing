<?php

require_once 'ManejadorBaseDeDatosInterface.php';

/**
 * Clase PostgreSQL
 *
 * A modo de ejemplo los parametros estan definidos
 * como constantes, pero en la "vida real" podrian
 * estar en un archivo de configuracion aparte.
 */
class PostgreSQL implements ManejadorBaseDeDatos
{

    const USUARIO = 'root';
    const CLAVE = '';
    const BASE = 'tarea5';
    const SERVIDOR = 'localhost';

    /**
     *
     * @var resource puntero a la conexion real
     */
    private $_conexion;

    public function conectar()
    {
        $this->_conexion = pg_connect(
                "host=" . self::SERVIDOR
                . " port=5432 dbname=" . self::BASE
                . " user=" . self::USUARIO
                . " password=" . self::CLAVE
        );
    }

    public function desconectar()
    {
        pg_close($this->_conexion);
    }

    /**
     *
     * @param Sql $sql
     * @return array
     */
    public function traerDatos(Sql $sql)
    {
        $resultado = pg_query($this->_conexion, $sql);

        while ($fila = pg_fetch_array($resultado, PGSQL_ASSOC)) {
            $todo[] = $fila;
        }
        return $todo;
    }

}