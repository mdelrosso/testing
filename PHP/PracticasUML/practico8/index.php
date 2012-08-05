<?php
require_once 'configuracion.php';
require_once PRE . DIRECTORY_SEPARATOR . 'UsuarioPresentacion.php';

abstract class Index
{
    const SIN_PARAMETROS = 0;
    
    static public function run($get)
    {
        DEBUG ? var_dump($get) : null;

        if(count($get) != self::SIN_PARAMETROS){

            self::_procesarModulo();

        }else{
            self::_porDefecto();
        }
    }
    static private function _porDefecto()
    {
        echo 'Pagina por Defecto';
        echo '<ul>';
        echo '<li><a href="?modulo=listado">listado</li>';
        echo '</ul>';
    }
    static private function _moduloNoExiste()
    {
        echo 'Modulo no Existe';
    }
    static private function _procesarModulo()
    {
        switch ($_GET['modulo']) {
            case 'listado':
              echo UsuarioPresentacion::listadoUsuarios();
              break;
            case 'detalle':
              echo UsuarioPresentacion::detalle($_GET['id']);
              break;
            default:
              self::_moduloNoExiste();
              break;
        }
    }
}

Index::run($_GET);
