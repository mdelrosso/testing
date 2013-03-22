# Mastering PHP

En este documento se recopilan los aspectos fundamentales y mas básicos de PHP.

## Indice
* [Sobre PHP](#sobre_php)
* [Tipos](#tipos)
* [Manipulación de tipos](#manipulacion_tipos)
* [Variables](#variables)
* [Constantes](#constantes)
* [Expresiones](#expresiones)
* [Operadores](#operadores)
* [Estructuras de control](#estructuras_de_control)
* [Funciones](#funciones)
* [Namespaces (Espacios de nombre)](#namespaces)
* [Excepciones](#excepciones)
* [Generadores](#generadores)
* [Protocolos y envolturas](#protocolos_y_envolturas)
* [Manejo de Conexiones HTTP en PHP](#manejo_de_conexiones)
* [Conexiones persistentes a base de datos](#conexiones_persistentes_a_base_de_datos)

* [Fuentes y links útiles](#fuentes_links_utiles)



<a id="sobre_php"></a>
## Sobre PHP

### PHP como CGI, como módulo de Apache o como plugin de un server multihilo

Hay 3 formas en las cuales el web server puede generar paginas web usando PHP.

El primer método es usar PHP como una "capa" CGI. Cuando se ejecuta de esta forma, una instancia del interprete PHP es creado y destruido por cada solicitud de la página (para una página PHP) al web server. Porque es destruido después de cada solicitud, cualquier recurso que se necesite (como un enlace a un servidor de base de datos SQL) son cerradas cuando son destruidas. En este caso, no se gana nada intentando usar conexiones persistentes -- simplemente no persisten.


La segunda, y mas popular, es ejecutar PHP como un modulo en un servidor multiproceso, el cual actualmente solo incluye a Apache. Un servidor multiproceso normalmente tiene un proceso (el padre) el cual coordina un grupo de procesos (los hijos) los cuales no trabajan sirviendo páginas web. Cuando una solicitud viene desde el cliente, es manejada por uno de los hijos el cual no este sirviendo a otro cliente. Esto significa que cuando el mismo cliente hace una segunda solicitud al servidor, podría ser servido por un proceso hijo diferente a la primera vez. Cuando se abre una conexión persistente, cada petición siguiente de servicios SQL puede reusar la misma conexión establecida al servidor SQL.


El último método es usar PHP como un plug-in para un servidor web multihilos. Actualmente PHP 4 tiene soporte para ISAPI, WSAPI, y NSAPI (en Windows), los cuales permiten usar PHP como un plug-in multihilo en servidores como Nestcape FastTrack (iPlanet), Microsoft Internet Information Server (IIS), y O'Reilly's WebSite Pro. El comportamiento es esencialmente el mismo para el modelo multiproceso descrito antes.



------------

<a id="tipos"></a>
## Tipos


8 tipos primitivos 2 pseudo-tipos.

* Escalares
    * boolean
    * integer
    * float
* Caracteres
    * string
* Compuestos
    * array
    * object
* Especiales
    * resource
    * NULL
* Pseudo-tipos
    * mixed
    * number
    * callback / callable

Para obtener información acerca de una variable: __var_dump()__  
Para obtener el tipo en formato string con proposito de debugueo: __gettype()__  
Para comprobar el tipo de una variable: __is_[tipo]__  

* NULL (IS_NULL)
* Booleans (IS_BOOL)
* Integers (IS_LONG)
* Floating point numbers (IS_DOUBLE)
* Strings (IS_STRING)
* Arrays (IS_ARRAY, IS_CONSTANT_ARRAY)
* Objects (IS_OBJECT)
* Resources (IS_RESOURCE)
* Callable (IS_CALLABLE)

### Características especiales de algunos tipos

__Strings__  
Entre comillas simples o literales: PHP interpreta el texto tal cual como está y no tiene funciones especiales salvo el escapado con \  
Entre comillas dobles: PHP interpretará el texto evaluando otras cosas mas avanzadas  

* Escapados y caracteres especiales: \n, \r
* Expande las variables: O sea que muestra su valor sin necesidad de hacer concatenaciones ni poner caracteres especiales. 
La gran mayoria funciona directamente incluso arrays "Imprimir esta $variable";
* Expresiones complejas usando {}: Tambien se pueden ejecutar sentencias mas complejas usando {$var}

La idea es insertar variables dentro de strings de la forma mas sencilla posible.
Codigo HEREDOC y NOWDOC: Son maneras de incluir grandes cantidades de texto sin necesidad de escaparlos.


__Arrays__  
En PHP 5.4 se puede hacer referencia a un array cuando es devuelto por una funcion directamente  
    $secondElement = getArray()[1];

Borrar un elemento de un array facilmente sin usar foreach:  
Los arrays mantienen un indexado con la cantidad de elementos creados independientemente de que se hayan borrado.  
Para resetear eso hay que reindexar el array: Esto se puede hacer facilmente usando array_values.  

    <?php 
    $a = array(1 => 'uno', 2 => 'dos', 3 => 'tres');
    unset($a[2]);

    var_dump($a);

    $a = array_values($a);
    var_dump($a);
    ?>

__Objects__  
El objeto mas basico de todo es el stdClass. Y es un objeto vacio que no hereda de nada.  
Se usa para almacenar propiedades y para cuando un array se convierte en objeto usando casteo.  


__Recursos__  
Son punteros a recursos externos: Bases de datos, Archivos, Porciones de imagenes, etc.  

__NULL__  
Variable sin valor asignado  
Variable con NULL asignado  
Variable destruida con unset()  

Un array vacio es convertido a null cuando se hace una comparacion con ==   
Usar === para comparar una variable array que podria ser empty  

__Llamadas de retorno__  
Son los "callables" de PHP. La idea es pasar la instrucción de ejecutar "algo" a otra funcion.  
En la practica seria algo asi ejecutar_una_funcion($parametro1, $parametro2, "$callable a ejecutar despues");  
El tercer parámetro es un objeto o funcion callable. O sea un parametro que le indica a la funcion que luego de hacer lo que tiene que hacer ejecute lo que el 3er parámetro le indica.  

Los callables pueden ser:  
Funcion: Directamente con un string 'nombreFuncion'  
Metodo de un objeto: array($obj, 'metodo como string');  
Metodo estático de una clase: array('clase', 'metodo estatico')  
Metodo estatico como string: 'Miclase::mimetodoEstatico'  
Funcion anonima: $variableQueContieneLaFuncionAnonima;  

Para ejecutar el objeto callable se debe usar  
call_user_func( callable  );  

A los objetos callables tambien se los suele llamar callbacks  

------------

<a id="manipulacion_tipos"></a>
## Manipulación de tipos

[PHP Manipulación de tipos](http://www.php.net/manual/es/language.types.type-juggling.php "Manipulación de tipos")

PHP es un lenguaje con tipado bajo demanda. El tipo de la variable cambia segun el valor asignado.

Se pueden forzar los tipos usando el __forzado de tipos__  

* (int), (integer) - forzado a integer
* (bool), (boolean) - forzado a boolean
* (float), (double), (real) - forzado a float
* (string) - forzado a string
* (array) - forzado a array
* (object) - forzado a object
* (unset) - forzado a NULL (PHP 5)


------------

<a id="variables"></a>
## Variables

Las variables por defecto se asignan por valor, aunque usando & se pueden asignar por referencia.  

No es necesario inicializarlas (aunque es una buena práctica) porque se inicializan según en contexto:  

* Booleanos: false
* Enteros y flotantes: cero
* Strings: cadena vacía 
* Matrices: array vacío

PHP provee variables predefinidas con información sobre el servidor, la petición, el contexto, etc.

### Ambito de las variables

Las variables por defecto tienen ambito global para el script (incluso si se incluyen archivos) y dentro de las funciones tienen ambito local.
Salvo que se definan dentro de la funcion como global:  

    <?php
        $a = 8;
        function holamundo() {
            global $a;
        }
    ?>

Tambien existe una variable $GLOBAL definida por PHP que hace que todo lo que se carge dentro esté disponible en cualquier ambito.

__Curiosidad:__ Variables de variables


    <?php 
    
    // Este código genera dos variables: $a con 'Hola' y $hola con 'mundo'
    $a = 'Hola';
    $$hola = 'mundo';
    
    ?>
 
### Asignar, pasar y devolver por referencia

Hay tres operaciones básicas que se realizan usando referencias: asignar por referencia, pasar por referencia, y devolver por referencia.
Referenciar significa que dos variables apuntan al mismo contenido.

Ejemplos de los tres casos:  


    <?php
    
        // Asignar por referencia
        $a =& $b;
        
        
        // Pasar por referencia
        function foo(&$var)
        {
            $var++;
        }

        $a=5;
        foo($a);
        
            
        // Devolver por referencia (En este caso el & hay que usarlo en ambos lados)
        function &collector() {
          static $collection = array();
          return $collection;
        }
        $collection = &collector();
        $collection[] = 'foo';
    ?>

[Variables predefinidas de PHP](http://www.php.net/manual/es/reserved.variables.php)

------------


<a id="constantes"></a>
## Constantes

__Definición:__

    // Funciona desde PHP 5.3.0
    const CONSTANT = 'Hola Mundo';
    
    // Clasica
    define("CONSTANT", "Hola mundo.");

__Constantes predefinidas:__ [Listado](http://www.php.net/manual/es/reserved.constants.php)

Son definidas por PHP y se caracterizan porque su nombre es siempre __NOMBRECONSTANTE__

Algunas cambian segun en donde se utilizen. ([Ver manual](http://www.php.net/manual/es/language.constants.predefined.php))


------------


<a id="expresiones"></a>
## Expresiones

Una expresión en programación es todo lo que tenga un valor.  
Tambien se debe agregar que las expresiones pueden evaluarse como __false__ o __true__ en los condicionales.

Ejemplos:  

    <?php
    
        // Asignacion
        $a = 1;
        
        // Incrementar uno con post-incremento
        $a++;
        
        // Incrementar uno con pre-incremento
        ++$a;
        
        // Incrementar 4
        $a += 4;
    
        // Expresión de comparación
        $primero ? $segundo : $tercero
        
        // Ejecutar una funcion
        $a = miFuncion(44);

    ?>


------------


<a id="operadores"></a> 
## Operadores  
Los operadores toman dos expresiones (valores) y los comparan para producir un tercer valor que es el resultado de la comparación.
Los operadores tambien forman una expresión.


------------


<a id="estructuras_de_control"></a>
## Estructuras de control  

Controlan el flujo de ejecución.  

Las clasicas:

* if
* else
* elseif/else if
* Sintaxis alternativa de estructuras de control
* while
* do-while
* for
* foreach
* break
* continue
* switch
* declare
* return
* require
* include
* require_once
* include_once
* goto


------------


<a id="funciones"></a>
## Funciones

Las funciones no necesitan ser definidas antes de ser utilizadas en el código.  
Solo hay que tener en cuenta que si la función se define dentro de algun condicional u otro tipo de bloque de código que no se ejecute siempre esto no cumple.

__Valor y referencia:__

Por defecto, los argumentos de las funciones son pasados por valor (por lo que si el valor del argumento dentro de la función se cambia, no se cambia fuera de la función). 
Para permitir a una función modificar sus argumentos, éstos deben pasarse por referencia.

Para hacer que un argumento a una función sea siempre pasado por referencia hay que poner delante del nombre del argumento el signo 'ampersand' (&) en la definición de la función.

__Argumentos variables:__  

Usando func_num_args(), func_get_arg(), y func_get_args() se pueden crear funciones que reciben un numero variable de argumentos.


------------


<a id="namespaces"></a>
## Namespaces (Espacios de nombre):  

Namespaces:
Un namespace es "un contenedor abstracto que agrupa de forma lógica varios símbolos e identificadores". 
En la práctica, los namespaces se utilizan para estructurar mejor el código fuente de la aplicación.
Sirve para no tener que crear clases con nombres largos para no colisionar con otras clases.

Afectan a clases, interfaces, funciones y constantes.

Los namespace se declaran con:

    namespace Cupon\TiendaBundle\Entity; 
    
Son la primera instrucción del archivo, no pueden contener ni siquiera espacios en blanco antes.
La unica excepción es: declare(encoding='UTF-8');

Se pueden definir __multiples__ namespaces en un mismo archivo pero se desaconseja totalmente, su uso esta solo permitido para agrupar diferentes archivos php en un mismo archivo.
La declaración alternativa namespace nombreespacio { ...... } sirve para este propósito aunque tambien se pueden declarar uno abajo del otro.

Tambien se puede definir un mismo espacio de nombres muchas veces en el mismo codigo lo cual permite una mejor organización.

    namespace miespaciouno;
    ....

    namespace miespaciodos;


Se usan con use:
Siempre se importan con un nombre completamente cualificado, por eso no se inclye la \ inicial porque se asume que es absoluto.
Esto es asi porque use es una instruccion que no depende del namespace activo.
La importación se realiza en tiempo de compilación por lo cual use va siempre fuera de toda declaración de clase, interfaz y funcion.

    use Cupon\OfertaBundle\Entity;

Para usar una clase directamente: (Usando su FQN: Fully Qualified Name)

    $oferta = new \Cupon\OfertaBundle\Entity\Oferta();

Para usar una clase mas cómodamente:

    use Cupon\OfertaBundle\Entity;

    $oferta = new Entity\Oferta();

Para usar una clase como siempre: ESTA ES LA RECOMENDADA

    use Cupon\OfertaBundle\Entity\Oferta;

    $oferta = new Oferta();

Tambien se puede crear un alias para la clase:

    use Cupon\OfertaBundle\Entity\Oferta as Offer;

    $oferta = new Offer();

Incluso reemplazar las nativas de PHP:

    use Cupon\OfertaBundle\Utilidades\DateTime;

    $fecha = new DateTime(); // Nuestra propia clase
    $fecha = new \DateTime(); // La clase nativa de PHP

        
Algunas cuestiones mas avanzadas:

    $d = namespace\MICONSTANTE; // véase la sección "El operador namespace y  la constante __NAMESPACE__" 
    $d = __NAMESPACE__ . '\MICONSTANTE';  
    echo constant($d); // véase la sección "Espacios de Nombres y características dinámicas del lenguaje"  

Especial para funciones y constantes:
Cuando se usan funciones o constantes dentro de un espacio de nombres el metodo de resolución es ligeramente distinto.   
Para las clases si o si hay que usar o un nombre completamente calificado o sino importar los espacios de nombres.
Pero las constantes si no está definido en el namespace actual PHP intentará usar el global.

    <?php 
    
    namespace MiEspacio\MiSubEspacio;
    
    use MiOtroEspacio\MiOtroSubEspacio\MiOtraClase;
    
    class MiClase {
        ....
        $obj = new MiOtraClase();
        
        /*
         * En este caso por mas que el namespace sea otro que no es global 
         * no hace falta hacer \is_object() porque PHP
         * lo entiende directamente
         * Primero busca dentro del namespace una funcion llamada is_object() 
         * y si no la encuentra va al global.
         * Esto es para facilitar el uso de las funciones mas comunes del lenguaje.
         * Sino habria que poner constantemente \is_object
         */
        echo is_object($obj);
    }

    ?>


------------


<a id="excepciones"></a>
## Excepciones

[Manual oficial de PHP](http://www.php.net/manual/es/language.exceptions.php)  
[Manual de programacion orientada a objetos para PHP. Cap 21. Anexo "Manejo de excepciones"](http://www.php.net/manual/es/book.errorfunc.php)  

Las excepciones se utilizan para realizar alguna acción en caso de que se produzca una situación anómala en el flujo normal del programa.  

Se suele tomar una medida básica ante un fallo. El mensaje de error al usuario es diferente según se esté en desarrollo o en produccion.  
En desarrollo se muestre un mensaje mas descriptivo mientras que en produccion uno mas amigable y que no exponga detalles de la aplicación a un extraño.  


### Beneficios de las Excepciones
Permiten separar el código de manejo de errores del código que debe cumplir con los requerimientos de funcionalidad de la aplicación.  
Permite un manejo homogéneo de los errores: evitará que tengamos distintas estructuras para contener los errores, como ser: en algunos casos una cascada de if, en otros un switch y tal vez en otros algún objetos de manejo de errores.  
No solo transfiere el control del sistema de un lugar a otro, sino que también trasmite información sobre la situación anómala: como unidad todas las excepciones manejan objetos de tipo Excepción y como todo objeto, tendrá atributos y métodos relacionados con el manejo de errores.  
  

### Excepciones en PHP
PHP no trae excepciones por defecto en la ejecución de sus funciones y objetos. 
Esto quiere decir que a bajo nivel se deberá validar con el tipico if/else y lanzar una Excepcion en su lugar.  

    $this->_link = mysql_connect('localhost', 'mysql_user', 'mysql_password'); 

    if (!$link) { 
        // /*En vez de esto*/ die('Could not connect: ' . mysql_error()); 
        
        // Hacer esto
        throw new Exception('Could not connect: ' . mysql_error()); 
    }

El objeto Exception puede ser extendido.  
Si una clase extiende la clase Exception interna y redefine el constructor, se recomienda encarecidamente que también llame a parent::__construct() para asegurarse que toda la información disponible haya sido asignada apropiadamente.  
El método __toString() puede ser sobrescrito para proporcionar una salida personalizada cuando el objeto es presentado como un string.  

__Exception__ es la clase base para todas las excepciones de PHP.  
__ErrorException__ es la especialización en errores y agrega el nivel o severidad del error.  
Tambien están las excepciones definidas en la SPL (standard PHP Library).  

[Excepciones predefinidas de PHP + SPL](http://www.php.net/manual/es/reserved.exceptions.php)  
[Excepciones SPL](http://www.php.net/manual/es/spl.exceptions.php)  

### Buenas practicas de excepciones

* No meter mucho código en try porque se ejecuta mas lento y consume recursos
* No manejar muchas excepciones en un mismo bloque try catch, cada cosa en su sitio.  
Si se maneja una excepción en un lugar muy alejado del lugar en donde falló, es posible que no se pueda hacer nada al respecto.  
Si no queda otra opcion entonces ponga un catch para cada tipo de excepcion.  

        try{
            //.... validhash
            //....newBookInsert
        } catch(invalidHashException $e) {

        } catch (newBookException $e){

        }
    
* Se maneja con excepciones todo aquello que no sean tan facil de validar o que pertenezca a otro sistema
* Como desarrolladores siempre tendremos dos caminos para decidir:  si ocurre una excepción, es responsabilidad de esa parte del código resolverla o deberá "relanzarla" al nivel superior para que este se encargue de hacer algo al respecto.  


------------


<a id="generadores"></a>
## Generadores

Los generadores proporcionan un modo fácil de implementar iteradores simples sin la sobrecarga o complejidad de implementar una clase que implemente la interfaz Iterator.
Un generador permite escribir código que utilice foreach para iterar sobre un conjunto de datos sin que sea necesario cargar el array en memoria, lo que puede ocasionar que se exceda el límite de memoria, o requiera una cantidad considerable de tiempo de procesado para generarse.

Se crearon con el objetivo de:

* Reducir complejidad
* Optimizar el uso de recursos

Una función generadora es igual que una función normal, con la diferencia de que en vez de devolver un valor, un generador invoca yield tantas veces como necesita.  
Cuando se llama a una función generadora, devuelve un objeto que puede ser iterado. Cuando se itera sobre ese objeto (por ejemplo, con un bucle foreach), PHP llamará a la función generadora cada vez que necesite un valor, y guardará el estado del generador cuando este provea un valor con yield para que ese estado pueda ser recuperado cuando el próximo valor sea requerido.   

Cuando no hay más valores que se puedan proporcionar, la función generadora puede simplemente terminar, y el código desde el que se la llama continuará como si un array se hubiera quedado sin valores.  

La clave está en el uso de la expresión __yield__ que se ejecuta dentro de la función generadora.
Equivale al return, solo que funciona un poco diferente. Devuelve el resultado al exterior de la función pero pausa su ejecución no la termina.
Esto permite que el foreach vuelva a iterar sobre ella y entonces se vuelve a ejecutar pero manteniendo el "contexto" 

La traducción de yield en ingles es: dar, ofrecer, entregar, ceder el paso

Un ejemplo simple de esto es reimplementar la función range() como un generador. La función estándar range() tiene que generar un array con cada uno de los valores y devolverlo, lo que puede resultar en arrays grandes: por ejemplo, llamar range(0, 1000000) resultará en más de 100 MB de memoria utilizada. 

    <?php
    function xrange($start, $limit, $step = 1) {
        if ($start < $limit) {
            if ($step <= 0) {
                throw new LogicException('Step tiene que ser +ve');
            }

            for ($i = $start; $i <= $limit; $i += $step) {
                yield $i;
            }
        } else {
            if ($step >= 0) {
                throw new LogicException('Step tiene que ser -ve');
            }

            for ($i = $start; $i >= $limit; $i += $step) {
                yield $i;
            }
        }
    }

    /* Obsereve que tanto range() como xrange() producen la misma
     * salida a continuación. */

    echo 'Números impares de una cifra de range():  ';
    foreach (range(1, 9, 2) as $number) {
        echo "$number ";
    }
    echo "\n";

    echo 'Números impares de una cifra de xrange():  ';
    foreach (xrange(1, 9, 2) as $number) {
        echo "$number ";
    }
    ?>


------------


<a id="protocolos_y_envolturas"></a>
## Protocolos y envolturas

Las envolturas (wrappers) son la forma que tiene PHP de acceder a recursos externos (Archivos, HTTP, Sockets, etc).  
Se relacionan con el concepto de streams y contextos.  
No tienen un objeto especifico para cada envoltura sino que están "embebidas" dentro de algunas funciones PHP.  
fopen por ejemplo según recibe una url o un uri internamente utilizará una u otra envoltura.  

Envolturas y protocolos soportados:

* file:// — Acceso al sistema de ficheros local
* http:// — Acceso a URLS en HTTP(s)
* ftp:// — Acceso a URLs por FTP(s)
* php:// — Acceso a distintos flujos de E/S
* zlib:// — Flujos de compresión
* data:// — Data (RFC 2397)
* glob:// — Encuentra las rutas que coincidan con el patrón
* phar:// — Archivo PHP
* ssh2:// — Secure Shell 2
* rar:// — RAR
* ogg:// — Flujos de audio
* expect:// — Flujos de Interacción de Procesos


------------

<a id="manejo_de_conexiones"></a>
## Manejo de Conexiones HTTP en PHP

Internamente en PHP se mantiene un estatus de la conexión.  
Hay 3 posibles estados: 

0 NORMAL  
1 ABORTED  
2 TIMEOUT  

Cuando un script en PHP esta ejecutándose, normalmente esta activo el estado NORMAL. Si el cliente remoto se desconecta, el flag ABORTED es activado. 
Un cliente remoto se desconecta usualmente porque el usuario presiona su botón STOP. Si el tiempo limite PHP-imposed (ver set_time_limit()) es activado, el flag TIMEOUT se activa.

Se puede decidir si se desea que un cliente se desconecte o no a causa de que se aborte el script. Algunas veces es útil que los scripts se ejecuten inclusive si ya no hay un navegador recibiendo la salida. El comportamiento por defecto es que el script sea abortado cuando el cliente remoto se desconecte. Este comportamiento puede ser establecido a través de la directiva ignore_user_abort en php.ini así como a través de la directiva correspondiente de Apache en httpd.conf php_value ignore_user_abort o con la función ignore_user_abort(). Si se decide no decirle a PHP que ignore abortar al usuario y el usuario aborta, el script terminará. La única excepción es si se tiene registrada una función de cierre usando register_shutdown_function(). Con una función de cierre, cuando el usuario remoto activa el botón STOP, la próxima vez que el script intente mostrar algo, PHP detectará que la conexión fue abortada y la función de cierre es llamada. Esta función de cierre también es llamada al final del script cuando termina normalmente, así que para hacer algo diferente en el caso de que un cliente se desconecte usar la función connection_aborted(). Esta función retornará TRUE si la conexión fue abortada.

El script puede ser terminado también por el temporizador incorporado en los scripts. El tiempo por defecto es de 30 segundos. Puede ser cambiado usando la directiva max_execution_time de php.ini o la correspondiente directiva php_value max_execution_time de Apache httpd.conf así como con la función set_time_limit(). Cuando el temporizador expira el script será abortado y así como el caso del cliente anterior que se desconecto, si la función de cierre ha sido registrada ésta será llamada. Dentro de esta función de cierre se puede comprobar para ver si el timeout causa la función de cierre llamando a la función connection_status(). Esta función retornará 2 si el timeout causo la llamada a la función de cierre.

Una cosa a notar es que ambos estados ABORTED y TIMEOUT pueden ser activados al mismo tiempo. Esto es posible si se le dice a PHP que ignore el aborto del usuario. PHP notará de hecho que un usuario podría haber roto la conexión, pero el script se mantendrá ejecutándose. Si este activa el limite de tiempo será abortado y la función de cierre, si existe, será llamada. A este punto, se encontrará que connection_status() retorna 3.



------------

<a id="conexiones_persistentes_a_base_de_datos"></a>
## Conexiones Persistentes a Bases de Datos

Las conexiones persistentes son enlaces que no se cierran cuando la ejecución del script termina.  
Cuando una conexión persistente es solicitada, PHP chequea si ya existe una conexión persistente idéntica (que fuera abierta antes) - y si existe, la usa. Si no existe, crea el enlace.  

Una conexión "Idéntica" es una conexión que fue abierta por el mismo host, con el mismo usuario y el mismo password (donde sea aplicable).

La conexiones persistentes permiten mejorar (no en todos los casos) la eficiencia.  
Las conexiones persistentes son buenas si la sobrecarga para crear enlaces al servidor SQL son altas.  

Que hallan o no sobrecargas depende de muchos factores. Como, cual base de datos se usa, que sea o no la misma computadora en que esta el servidor web, así como la carga de la maquina que tiene el servidor SQL y así por el estilo. Lo esencial es que si la sobrecarga de conexiones es alta, las conexiones persistentes ayudan considerablemente. Podrían causar que los procesos hijos únicamente se conecten una vez en todo lo que duran, en lugar de que se haga cada vez que se procese una página que se conecte a un servidor SQL. Esto significa que por cada hijo que abrió una conexión persistente mantendrá una conexión persistente al servidor. Por ejemplo, si se tienen 20 procesos hijos diferentes que ejecutaran un script que hace una conexión persistente al servidor SQL, se tendrían 20 conexiones diferentes al servidor SQL, una por cada hijo.

Nótese, sin embargo, que esto puede tener algunos inconvenientes si se esta usando una base de datos con un limite de conexiones que sean excedidas por las conexiones persistentes hijas. Si la base de datos tiene un limite de 16 conexiones simultaneas, y en el curso de una sesión ocupada del servidor, 17 hilos intentan conectarse, uno no sera posible de hacerse. Si hay bugs en los scripts los cuales no contemplen los cierres de las conexiones (como un loop infinito), la base de datos con los 16 conexiones podría rápidamente hundida. Chequear la documentación de la base de datos para obtener información de como manejar conexiones abandonadas u ociosas. 








------------


<a id="fuentes_links_utiles"></a>
## Fuentes y links útiles

* [Manual oficial de PHP en PHP.net](http://www.php.net/manual/es/ "PHP official site")
* [Variables predefinidas de PHP](http://www.php.net/manual/es/reserved.variables.php)
* [Excepciones predefinidas de PHP + SPL](http://www.php.net/manual/es/reserved.exceptions.php)
* [Interfaces predefinidas + SPL](http://www.php.net/manual/es/reserved.interfaces.php)