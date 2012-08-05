<?php

require_once 'Sistema.php';
require_once 'DiscoDuro.php';

/**
 *
 * @author Gabriel
 */
class Index
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
        
        $discoC = new DiscoDuro("C");
        $discoD = new DiscoDuro("D");
        
        $sistema = new Sistema();
        
        $sistema->addDiscoDuro($discoC);
        $sistema->addDiscoDuro($discoD);
        
        $discoC->addDirectorio("home", '/');
        
            $discoC->addDirectorio("usuario1", 'home');
                $discoC->addDirectorio("download", 'usuario1');
                    $discoC->addDirectorio("videos", 'download');
                        $discoC->addArchivo("video1.avi", 'videos');
                        $discoC->addArchivo("video2.avi", 'videos');
        
            $discoC->addDirectorio("usuario2", 'home');
                $discoC->addDirectorio("mp3s", 'usuario2');
                    $discoC->addArchivo("michaeljackson.mp3", 'mp3s');
        
            $discoC->addDirectorio("usuario3", 'home');
                $discoC->addDirectorio("docs", 'usuario3');
                    $discoC->addDirectorio("cv.doc", 'docs');
        
        
        $discoD->addDirectorio("tmp", '/');
            $discoD->addArchivo("nada.txt", 'tmp');
            
        /*echo "<pre>";
            print_r($discoC);
            print_r($discoD);
        echo "<pre>";*/
        
        //Buscamos el archivo michaeljackson.mp3 en el HD C
        $busquedaC = $sistema->buscar("C", "michaeljackson.mp3");    
        
        //Buscamos la carpeta tmp en el HD D
        $busquedaD = $sistema->buscar("D", "tmp");
        
        
        echo "<pre>";
            print_r($busquedaC);
        echo "</pre>";
        
        echo "<pre>";
            print_r($busquedaD);
        echo "</pre>";        
    }

}

Index::run();
