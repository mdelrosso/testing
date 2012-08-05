<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Usuario.php';

abstract class UsuarioPresentacion
{
    public static function listadoUsuarios()
    {
        $usuario = new Usuario();
        $usuarios_arr = $usuario->getAll();
        
        $retorno = '<ul>';
        foreach($usuarios_arr as $objetoUsuario){
            /*
             * Armo el listado html a partir del 
             * toString de cada objeto
             */
            $retorno .= '<li>'.$objetoUsuario.'</li>';
        }
        $retorno .= '</ul>';
        return $retorno;
    }
    public static function detalle($id)
    {
        $usuario = new Usuario($id);
        return 'Recibi un id = '.$id;
        /* El objeto ya se cargó de la persistencia,
         * Armo el html para mostrar la información
         * del objeto usuario recibido
         */
    }
}