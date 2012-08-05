<?php

require_once 'db/BaseDeDatos.php';
require_once 'db/MySQL.php';
require_once 'db/Sql.php';

/**
 *
 * @author Gabriel
 */
class Admin extends Persona
{

    private $_id;
    private $_nombreUsuario;
    private $_sistema = "";
    private $_fechaUltimoIngreso = "";

    public function __construct($nombre = "", $apellido = "", $nombreUsuario="", $mail = "", $sistema = "", $fechaUltimoIngreso = "")
    {
        parent::__construct($nombre, $apellido, $mail);

        $this->_nombreUsuario = $nombreUsuario;
        $this->_sistema = $sistema;
        $this->_fechaUltimoIngreso = $fechaUltimoIngreso;
    }

    public function load($idz = 0)
    {
        $bd = new BaseDeDatos(new MySQL());

        $sql = new Sql();

        $sql->addTable('admins');
        $sql->addWhere("id = $id");

        $admin = $bd->ejecutar($sql);

        if (count($admin) > 0) {
            parent::__construct($admin[0]['nombre'], $admin[0]['apellido'], $admin[0]['mail']);

            $this->_id = $admin[0]['id'];
            $this->_nombreUsuario = $admin[0]['nombre_usuario'];
            $this->_sistema = $admin[0]['sistema'];
            $this->_fechaUltimoIngreso = $admin[0]['fecha_ultimo_ingreso'];

            return $this;
        }

        return null;
    }

    public function save()
    {
        $bd = new BaseDeDatos(new MySQL());

        $valores = array(
            'nombre' => parent::getNombre(),
            'nombre_usuario' => $this->_nombreUsuario,
            'apellido' => parent::getApellido(),
            'mail' => parent::getMail(),
            'sistema' => $this->_sistema,
            'fecha_ultimo_ingreso' => $this->_fechaUltimoIngreso
        );

        $bd->insertar("admins", $valores);
    }

    public function __toString()
    {
        return $this->_nombreUsuario;
    }
}
