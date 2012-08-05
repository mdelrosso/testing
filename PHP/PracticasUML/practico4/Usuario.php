<?php

require_once 'db/BaseDeDatos.php';
require_once 'db/MySQL.php';
require_once 'db/Sql.php';

/**
 *
 * @author Gabriel
 */
class Usuario extends Persona
{

    private $id;
    private $nombreUsuario;

    public function __construct($nombre = "", $apellido = "", $mail = "", $nombreUsuario = "")
    {
        parent::__construct($nombre, $apellido, $mail);

        $this->nombreUsuario = $nombreUsuario;
    }

    public function load($id)
    {
        $bd = new BaseDeDatos(new MySQL());

        $sql = new Sql();

        $sql->addTable('usuarios');

        $sql->addWhere("id = $id");

        $usuario = $bd->ejecutar($sql);

        if (count($usuario) > 0) {
            parent::__construct($usuario[0]['nombre'], $usuario[0]['apellido'], $usuario[0]['mail']);

            $this->id = $usuario[0]['id'];
            $this->nombreUsuario = $usuario[0]['nombre_usuario'];

            return $this;
        }

        return null;
    }

    public function save()
    {
        $bd = new BaseDeDatos(new MySQL());

        $valores = array(
            'nombre' => parent::getNombre(),
            'apellido' => parent::getApellido(),
            'mail' => parent::getMail(),
            'nombre_usuario' => $this->nombreUsuario
        );

        $bd->insertar("usuarios", $valores);
    }

    public function __toString()
    {
        return $this->nombreUsuario;
    }

}

?>
