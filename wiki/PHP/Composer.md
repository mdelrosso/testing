# Composer

## Fuentes

* Desymfony 2012
* [Sitio oficial](http://getcomposer.org/)

## ¿Qué es?

Es una herramienta que permite declarar cuales son las librerias de las que depende nuestro proyecto y las instala por nosotros.
Es un manejador de dependencias.

## ¿Cómo se instala?

Composer es un .phar (o php compilado para su uso en linea de comandos) que se descarga y se pone en un directorio general del sistema desde el cual se puede usar facilmente.


## Composer Vs PEAR

* PEAR es a nivel de sistema COMPOSER no
* Solo distribuciones no source
* No permite diferentes origenes de datos
* COMPOSER es compatible con PEAR

## Características de composer

* Se apoya en otros sistemas para manejar los archivos (git, svn, cvs, http file transfer)
* __Autoload de clases:__ Ademas maneja el autoload de clases creando un archivo que sigue el estándar para que luego sea sencillo de utilizar
* Diferentes maneras de configurar el paquete y de obtener paquetes y dependencias
    * __Packagist:__  
    Packagist es un sitio web donde se reunen todos los paquetes y dependencias.  
    Repositorio central de composer  
    Funciona como proxy entre los repositorios de codigo originales y el proyecto.  
    Parsea y cache los ficheros de los repos para que sea mas rápido acceder.  
    Cualquier código PHP puede estar dentro de packagist  
    Publicar paquetes en packagist: Se hace agregando mas info al composer.json  
    
    * __Directamente desde Repositorio SVN, GIT, HG como si fuera packagist:__  
    No hace falta que este en packagist para poder manejar las dependencias con composer.  
    Con que en el repositorio de codigo tenga un composer.json ya composer puede detectarlo como una dependencia valida.  
    Creo que esta es la opcion que maneja Symfony  
    
    * __Desde PEAR:__  
    Se puede obtener desde PEAR  
    
    * __Sin que la dependencia tenga configurado con composer.json:__  
    El composer.json se pone como type: package y se define el json dentro del propio composer.json nuestro como si estuvera en el remoto  
    
    * __Satis:__   
    Version reducida de packagist para instalar en la empresa  
    Requiere algunas cosas como Redis  
    Es ideal para repositorios privados  
    La idea es que se puedan manejar dependencias internas en la empresa usando un packagist privado  
* Hooks: Se le llaman scripts y son como callbacks que se ejecutan pre o post instalar/actualizar dependencias.

## Composer.json y Composer.lock

* __composer.json:__  
    Define lo que el proyecto necesita. De que depende Vendor/Paquete y Versión o rango de versiones
    
* __composer.lock:__
    Reemplaza al composer.json y congela las dependencias concretas del proyecto  
    Contiene la lista exacta de dependencias con sus versiones concretas  
    Se deberia añadir al VCS

## Comando install vs update

* __Install__:  
    Chequea si existe composer.lock y baja exáctamente esas versiones sin importar lo que diga el composer.json
    Si no existe utiliza el json y luego crea el lock
    Esto sirve para que todos los que trabajen en el proyecto tengan exactamente las mismas versiones
    
* __Update__:  
    El comando update se fija en el json y chequea los repositorios en busca de las versiones, si existe alguna nueva version la baja y al finalizar el proceso actualiza el lock
    

## Composer en Symfony 2

En symfony todos son dependencias incluso los componentes del sistema.
Tambien los bundles son dependencias.
En la v2.1 solo se ponen las dependencias directas de nuestro proyecto no las sub-dependencias

## Composer y su relación con los Sistemas de control de versiones (VCS)

* Composer guarda todos los archivos siguiendo la nomenclatura __/vendor/{vendorName}/{packageName}/*.*__ por lo cual ese directorio deberia estar fuera del control de versiones
* Agregar el composer.lock y composer.json


## ¿Cómo se referencias las versiones?

* Versión exacta
* Rango de versiones (>=1.2.3,<1.3) o Versiones con wilcards (1.0.*)
* Rama especifica (dev-master)

## Autoloading

Composer genera automáticamente un clase que se encarga del autoload de clases.
Esta clase configurada correctamente y lista para ser usada se obtiene agregando el archivo vendor/autoload.php.

    // Incluye el autoload
    $loader = require 'vendor/autoload.php';
    
    // Si se quieren agregar mas namespaces se puede hacer facilmente
    $loader->add('Acme\Test', __DIR__);

Ademas crea varios archivos dentro del directorio vendor/composer que sirven para realizar el autoload con otro loader o manualmente.
Crea un mapa de clases y un mapa de namespaces siguiendo la nomenclatura PSR-0.
Estos dos archivos son los mismos que utiliza el propio autoload de composer. 


## Snippets


### Script para simplificar el uso

En windows composer.bat:  

    @ECHO OFF
    php "%~dp0composer.phar" %*

### Ver las opciones disponibles

    php composer.phar

### Crear un proyecto

    // Sintaxis
    php composer.phar create-project <vendor>/<package> <directorio del proyecto> <versión>

    // Ejemplo
    php composer.phar create-project symfony/framework-standard-edition /www/symfony21 2.1.x-dev

### Instalar las dependencias de un proyecto ya creado

    php composer.phar install
    

### Actualizar las dependencias de un proyecto

    php composer.phar update

### Actualizar el propio código de composer

    php composer.phar self-update // Revisar esto!! NO SE SI ES ASI

## Deficiencias/TODOs conocidos

* Colisión entre librerias que tienen dependencias iguales pero de diferentes versiones.

