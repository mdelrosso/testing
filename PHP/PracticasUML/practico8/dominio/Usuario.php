<?php
require_once 'configuracion.php';
require_once PER . DIRECTORY_SEPARATOR . 'UsuarioPersistencia.php';

/**
 * Description of Usuario
 *
 * @author Pc
 */
class Usuario
{
   public function getAll()
   {
       $usuarioPersistencia = new UsuarioPersistencia();
       $datos_array = $usuarioPersistencia->getAll();

       foreach($datos_array as $usuario_array){
           /* por cada dato, armo un objeto de tipo
            * Usuario y lo guardo en un array para
            * luego retornar una colección de
            * objetos, no datos sueltos
            */
           $retorno[] = new Usuario();
       }
       return $retorno;
   }
}