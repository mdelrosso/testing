<?php

require_once 'Usuario.php';
require_once 'Admin.php';

abstract class Index
{

    public static function main()
    {
        //echo "<pre>";
        
                 
        //INSERTAMOS ADMIN
        $admin1 = new Admin("Gabriel", "Alonso", "g.alonso", "gabriel@gmail.com", "Sistema 1", "2001-12-20");        
        $admin1->save();

        //INSERTAMOS USUARIO
        $usuario1 = new Usuario("Roberto", "Roca", "roberto@gmail.com", "roberto");
        $usuario1->save();
        
        
        /*
        //LEVANTAMOS USUARIO
        $usuario = new Usuario();
        $usuario->load(4);        
        echo $usuario;
        
        echo "<br />";
        //LEVANTAMOS ADMIN
        $admin = new Admin();
        $admin->load(20);        
        echo $admin;
        */
        
        //echo "</pre>";
    }

}

Index::main();
