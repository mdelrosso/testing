<?php

require_once 'Item.php';
require_once 'Cliente.php';

class Factura
{

    static public $ultimoId = 0;
    private $_id;
    private $_cliente;
    private $_items = array();

    public function __construct(Cliente $cliente, $items=array())
    {
        self::$ultimoId++;
        $this->_id = self::$ultimoId;

        $this->setCliente($cliente);

        foreach ($items as $k => $item) {
            $this->addItem($item['articulo'], $item['proveedor']);
        }
    }

    private function setCliente(Cliente $cliente)
    {
        $this->_cliente = $cliente;
    }

    private function addItem(Articulo $articulo, Proveedor $proveedor)
    {

        $this->_items[] = new Item($articulo, $proveedor);
    }

    public function getId()
    {
        return $this->_id;
    }
    
    public function armarFactura()
    {

        $s = "<p>###########################</p>";
        $s .= "Numero de factura: " . $this->_id . " <br />";
        $s .= "Facturar a: " . $this->_cliente->getNombre() . " <br />";

        foreach ($this->_items as $k => $item) {
            $s .= $item->getData() . "<br />";
        }

        return $s;
    }

}
