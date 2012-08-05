<?php

require_once('Factura.php');
require_once('Cliente.php');
require_once('Articulo.php');
require_once('Proveedor.php');

abstract class FacturaFactory
{

    static public function getFactura($id)
    {

        $factura = array();

        Factura::$ultimoId = 0;

        $facturas[] = new Factura(
                        new Cliente("Juan"),
                        array(
                            array(
                                'articulo' => new Articulo("Mother"),
                                'proveedor' => new Proveedor("Asus")
                            ),
                            array(
                                'articulo' => new Articulo("Micro"),
                                'proveedor' => new Proveedor("AMD")
                            )
                        )
        );

        $facturas[] = new Factura(
                        new Cliente("Pepe"),
                        array(
                            array(
                                'articulo' => new Articulo("Memoria"),
                                'proveedor' => new Proveedor("Kingston")
                            ),
                            array(
                                'articulo' => new Articulo("Disco Rigido"),
                                'proveedor' => new Proveedor("WD")
                            )
                        )
        );

        foreach ($facturas as $k => $factura) {
            if ($factura->getId() == $id) {
                return $factura;
            }
        }
    }

}
