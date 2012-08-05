<?php

interface ManejadorBaseDeDatos
{

    public function conectar();

    public function desconectar();

    /**
     * La firma tiene definido el parametro y el tipo
     * que deberan cumplir todas las clases
     * que implementen esta interfaz
     */
    public function traerDatos(Sql $sql);
    
    public function insertar($tabla, $valores);
}