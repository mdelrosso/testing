<?php

require_once 'DiscoDuro.php';

abstract class Index
{

    public static function run()
    {
        /*
            /home/usuario1/download/videos/video1.avi
            /home/usuario1/download/videos/video2.avi
            /home/usuario2/mp3s/michaeljackson.mp3
            /home/usuario3/docs/cv.doc
                  
            /tmp/nada.txt
        */
        echo "<pre>";
        
            /*DISCO 1*/
            $discoDuro1 = new DiscoDuro();

            $discoDuro1->agregarArchivo('home',  "2012-01-01", 'DIR', '/');
            
                $discoDuro1->agregarArchivo('usuario1', "2012-01-02",'DIR', "home");                
                    $discoDuro1->agregarArchivo('download', "2012-01-03",'DIR', "usuario1");
                        $discoDuro1->agregarArchivo('videos', "2012-01-04",'DIR', "download");
                            $discoDuro1->agregarArchivo('video1.avi', "2012-01-05",'FILE', "videos");
                            $discoDuro1->agregarArchivo('video2.avi', "2012-01-19",'FILE', "videos");
                            
                $discoDuro1->agregarArchivo('usuario2', "2012-02-15",'DIR', "home");                                
                    $discoDuro1->agregarArchivo('mp3s', "2012-02-16",'DIR', "usuario2");
                        $discoDuro1->agregarArchivo('michaeljackson.mp3', "2012-02-17",'FILE', "mp3s", true);

                $discoDuro1->agregarArchivo('usuario3', "2012-02-15",'DIR', "home");                
                    $discoDuro1->agregarArchivo('docs', "2012-02-15",'DIR', "usuario3");                
                        $discoDuro1->agregarArchivo('cv.doc', "2012-02-18",'FILE', "docs");
            
            /*DISCO 2*/
            $discoDuro2 = new DiscoDuro();
            
            $discoDuro2->agregarArchivo('tmp', "2012-02-15",'DIR', "/");                
                $discoDuro2->agregarArchivo('nada.txt', "2012-02-15",'FILE', "tmp");                

            echo "############### CONTENIDO DISCO 1 ###############<br />";
            print_r($discoDuro1);    
            
            echo "############### CONTENIDO DISCO 2 ###############<br />";
            print_r($discoDuro2);
            
            
            echo "############### RESULTADO BUSQUEDA POR NOMBRE video1.avi EN DISCO 1 ###############<br />";
            $findByNameResult = $discoDuro1->buscarPorNombre("video1.avi");                   
            print_r($findByNameResult);
            
            echo "############### RESULTADO BUSQUEDA POR EXTENSION doc EN DISCO 1 ###############<br />";
            $findByExtensionResult = $discoDuro1->buscarPorExtension("doc");                   
            print_r($findByExtensionResult);
            
            
            echo "############### RESULTADO BUSQUEDA POR FECHA 2012-01-19 EN DISCO 1 ###############<br />";
            $findByExtensionResult = $discoDuro1->buscarPorFechaCreacion("2012-01-19");                   
            print_r($findByExtensionResult);
            
            
            echo "############### RESULTADO BUSQUEDA DE ARCHIVOS INFECTADOS EN DISCO 1 ###############<br />";
            $findByExtensionResult = $discoDuro1->buscarPorInfectados();                   
            print_r($findByExtensionResult);   
           
            echo "<br /><br />-----------------------------------------------------------------------------------------<br /><br /><br />";
            
            echo "############### RESULTADO BUSQUEDA POR EXTENSION txt EN DISCO 2 ###############<br />";
            $findByExtensionResult = $discoDuro2->buscarPorExtension("txt");                   
            print_r($findByExtensionResult);
            
            echo "############### RESULTADO BUSQUEDA DE ARCHIVOS INFECTADOS EN DISCO 2 ###############<br />";
            $findByExtensionResult = $discoDuro2->buscarPorInfectados();                   
            print_r($findByExtensionResult);
            
            
        echo "<pre>";
        
    }

}

Index::run();
