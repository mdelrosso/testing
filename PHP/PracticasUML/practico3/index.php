<?php

require_once 'Empresa.php';
require_once 'GerenteSistemas.php';
require_once 'Desarrollador.php';
require_once 'Proyecto.php';

/**
 * Main
 *
 * @author Gabriel
 */
class Index
{

    static function main()
    {
        /* Empresa */
        $surforce = new Empresa("Surforce");

        /* Gerentes */
        $gerenteJuan = new GerenteSistemas("Juan");
        $gerentePedro = new GerenteSistemas("Pedro");

        /* Desarrolladores */
        $desarrolladorCarlos = new Desarrollador("Carlos");
        $desarrolladorSebastian = new Desarrollador("Sebastian");
        $desarrolladorLinus = new Desarrollador("Linus");

        /* Proyectos */
        $proyectoCore = new Proyecto("2012-05-01", "2012-05-30", "CORE");
        $proyectoSocial = new Proyecto("2012-06-01", "2012-06-30", "SOCIAL");

        //Los desarrolladores aprenden los siguientes lenguajes
        $desarrolladorCarlos->aprenderPhp5();
        $desarrolladorSebastian->aprenderPhp5();
        $desarrolladorLinus->aprenderPhp5()->aprenderZendFramework();

        //Agregamos los gerentes a la empresa Surforce
        $surforce->agregarGerenteSistemas($gerenteJuan);
        $surforce->agregarGerenteSistemas($gerentePedro);

        //Agregamos los desarrolladores a la empresa Surforce
        $surforce->agregarDesarrollador($desarrolladorCarlos);
        $surforce->agregarDesarrollador($desarrolladorSebastian);
        $surforce->agregarDesarrollador($desarrolladorLinus);

        //Agregamos los proyectos a la empresa Surforce
        $surforce->agregarProyecto($proyectoCore);
        $surforce->agregarProyecto($proyectoSocial);

        //Asignaciones        
        try {
            $surforce->asignarDesarrolladorAProyecto($desarrolladorCarlos, $proyectoCore);
            $surforce->asignarDesarrolladorAProyecto($desarrolladorSebastian, $proyectoCore);
            $surforce->asignarDesarrolladorAProyecto($desarrolladorLinus, $proyectoSocial);

            $surforce->asignarGerenteSistemasAProyecto($gerenteJuan, $proyectoCore);
            $surforce->asignarGerenteSistemasAProyecto($gerentePedro, $proyectoSocial);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        
        /*DUMPS*/
        
        echo "<h1>$surforce</h1>";

        echo "<ul>";
        foreach ($surforce->getAllProyectos() as $k => $proyecto) {
            $gerenteSistemas = $proyecto->getGerenteSistemasACargo();
            echo "<li><p>$proyecto</p>
                    <b>Gerente Sistemas:</b>
                    <ul>
                        <li>$gerenteSistemas</li>
                    </ul>    

                    <b>Desarrolladores:</b>
                    <ul>";
            foreach ($proyecto->getAllDesarrolladores() as $k => $desarrollador) {
                echo "<li>" . $desarrollador;
                foreach ($desarrollador->getLenguajesQueConoce() as $k => $lenguaje) {
                    echo "<ul>";
                        echo "<li>$lenguaje</li>";
                    echo "</ul>";
                }
                echo "</li>";
            }
            echo "      </ul>
                    </li>";
        }
        echo "</ul>";


        echo "<h1>Proyectos asociados al desarrollador $desarrolladorLinus</h1>";
        
        echo "<ul>";
        foreach ($surforce->buscarProyectosDesarrollador($desarrolladorLinus->getNombre()) as $k => $proyecto) {
            echo "<li>
                        <p>$proyecto</p>
                     </li>";
        }
        echo "</ul>";
    }

}

Index::main();
