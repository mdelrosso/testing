<?php

require_once 'Articulo.php';
require_once 'Proveedor.php';

class Item
{

    private $_articulo;
    private $_proveedor;

    public function __construct(Articulo $articulo, Proveedor $proveedor)
    {
        $this->_articulo = $articulo;
        $this->_proveedor = $proveedor;
    }

    public function getData()
    {
        return $this->_articulo->getNombre() . " " . $this->_proveedor->getNombre();
    }

}
