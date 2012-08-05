<?php
require_once 'configuracion.php';

require_once PER . DIRECTORY_SEPARATOR . 'BaseDeDatos.php';
require_once PER . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once PER . DIRECTORY_SEPARATOR . 'Sql.php';

class UsuarioPersistencia
{
  public function getAll()
  {
      /* Usa las clases de persistencia y retornara 
       * solo datos extraidos de la base de datos, 
       * la clase de dominio se encargará de armar los 
       * objetos y entregarlos a la capa de 
       * presentacion
       */

        $bd = new BaseDeDatos(new MySQL());
        $sql = new Sql();

        $sql->addTable('usuarios');
        
        $resultado_arr = $bd->ejecutar($sql);

        var_dump($resultado_arr);
        die();
        return $resultado_arr;
  }
}