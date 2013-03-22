# Symfony2 - Snippets




## Pruebas en el navegador
http://www.<DOMAIN>/app_dev.php/

## Path para trabajar con la consola en entorno Windows

set path=%path%;C:\Program Files\Git\bin;C:\wamp\bin\php\php5.3.9

## Chequear requisitos

php app/check.php

## Chequear consola

php app/console

## Crear proyecto

Crear un proyecto con symfony2 + vendors con composer y repo en github:
[Symfony.com doc oficial](http://symfony.com/doc/current/cookbook/workflow/new_project_git.html)

1. Crear un repo vacio con Git clonando uno de github
2. Bajar la version sin vendor de symfony desde el sitio web:  
    Los vendor se manejarán luego con composer porque sino se deberían manejar con sub-modules de git  
    Los vendors no se agregan al repositorio. De hecho esta ignorada la carpeta entera  
    Incluso el propio framework está puesto en librerias dependientes y se administra con composer  
    Lo que se baja cuando se baja sin vendors son algunos archivos que si se quisieran ejecutar no funciona nada. (Es solo el esqueleto)  
3. Configurar el .gitignore:  
    Ignora archivos con configuraciones sensibles, y los directorios vendores, logs, cache, etc.
4. Agregar y commitear todo al repositorio
5. Instalar vendors con "composer install"
    

## Crear un Bundle

[Manual](http://symfony.com/doc/current/cookbook/bundles/best_practices.html#index-1)

Se crea con la consola. (generate:bundle)  
Básicamente se especifica el namespace y el nombre.  
Despues hay algunas opciones mas comunes: Formato de configuracion, directorio, generar estructura completa, activar bundle, configurar ruteo.  

En app/appKernel.php se pueden ver los cambios hechos  
Lo mismo en app/config/routing.yml  

### Shortcut de creación

    $ php app/console  generate:bundle --namespace=Cupon/CiudadBundle --bundle-name=CiudadBundle --dir=src/ --format=yml --structure=no --no-interaction  

-------------------------------
    
## Doctrine

### Entities

    symfony generate:doctrine:entities <NombreBundle> // Genera setters y getters para las entidades

### Schema

    symfony doctrine:schema:create  // Executes (or dumps) the SQL needed to generate the database schema  
    symfony doctrine:schema:drop    // Executes (or dumps) the SQL needed to drop the current database schema  
    symfony doctrine:schema:update --force  // Actualiza el schema de la base de datos  
    
    symfony doctrine:fixtures:load --purge-with-truncate  
    --fixtures=app/Resources  
    --fixtures=src/Cupon/OfertaBundle/DataFixtures/ORM  
    *** Fixtures se puede usar multiples veces para indicar muchos archivos  
    
    