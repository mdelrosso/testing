<?php

/**
 * Clase Sql
 */
class Sql
{

    /**
     *
     * @var array coleccion de condiciones where
     */
    private $_colWhere = array();

    /**
     *
     * @var array coleccion de campos select
     */
    private $_colSelect = array('*');

    /**
     *
     * @var array coleccion de tablas
     */
    private $_colFrom = array();

    /**
     *
     * @param string $table
     */
    public function addTable($table)
    {
        $this->_colFrom[] = $table;
    }

    /**
     *
     * @param string $where
     */
    public function addWhere($where)
    {
        $this->_colWhere[] = $where;
    }

    /**
     *
     * @return string consulta sql armada
     */
    private function _generar()
    {
        $select = implode(',', array_unique($this->_colSelect));
        $from = implode(',', array_unique($this->_colFrom));
        $where = implode(' AND ', array_unique($this->_colWhere));

        return 'SELECT ' . $select . ' FROM ' . $from . ' WHERE ' . $where;
    }

    public function __toString()
    {
        return $this->_generar();
    }

}