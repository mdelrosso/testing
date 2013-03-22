# Symfony 2 - Internals


## Fuentes

* Desymfony2012 - Symfony2 internals
* Github: raulfraile. Subio un ACME modificado que indica que sucede en cada paso de la petición

## Ejecución de una petición en Symfony2

* __Boostrap, configuración y registro de autoload__  
    * Incluye el archivo bootstrap.php.cache
        * Prepara el objeto loader que lo delega en el composer. Composer reune todos los namespaces de vendor necesarios en un mapa
        * Registra el loader creado anteriormente
    * Registra todas las clases e interfaces que se usan siempre en todas las peticiones
    Estan definidas todas juntas en este archivo
* __Configuración del appKernel__
En este paso define la clase appKernel que extiende de kernel y se le sobreescriben los metodos de configuracion de bundles y de configuracion de la app.
No se ejecuta ningun código solo se define la clase appKernel que será construida en el próximo paso.

* __Construcción del appKernel__  
En este paso solo setea valores dentro del appKernel que seran usados mas adelante.
La unica diferencia está en que si se especifica debug=true registra algunas cosas adicionales relacionadas al manejo de errores con excepciones.

* __Carga de la cache de clases: Kernel->loadClassCache()__  
Carga un archivo que tiene un cacheo con un mapa de FQN a Paths que podrían ejecutarse pero que no siempre lo hacen.
Con esto optimiza luego el proceso de autoload
Este paso no hace nada si es la primera vez que se ejecuta una petición ya que no tiene cargado nada en cache.
Cuando se haga el handle de la peticion y se detecte que el sistema no está booteado ejecutará primero el booteo que es donde se crean los archivos de cacheo

* __Creación de la http Request en base a los GLOBALS__  
Crea el objeto request usando las variables globales proporcionadas por PHP

* __Booteo: Creación del contexto, procesamiento de la petición y creación de la Response__
El booteo es un proceso importante porque es el que prepara todo lo necesario para poder ejecutar symfony. Tambien guarda muchas cosas en cache para la próxima ejecución.
    * Booteo del sistema
        * Inicializa entorno: Dependency Injection Container (DIC) + Bundles
            * Inicializa bundles
            * Inicializa DIC
                Usa un builder para construir el DIC
                Registra los servicios y sus dependencias
                De cada bundle se registran sus dependencias
            * Inyecta el DIC en cada bundle
    * El objetivo de este paso es construir y devolver un objeto response
        Todo se maneja con eventos. El kernel dispara eventos y el frameworkBundle responde a ellos
        * Evento kernel.request: Nueva request
            * Framework bundle: Busca el controlador adecuado para la ruta pedida. Cuando lo encuentra lo agrega a la request
        * Evento kernel.controller: Controlador obtenido
            * Genera la response usando el controlador obtenido
        * Evento kernel.response: Response obtenido
            * Si hay excepciones es en este paso donde desvia el flujo y la muestra en pantalla