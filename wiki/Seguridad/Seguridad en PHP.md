# Seguridad en PHP

## Recomendaciones generales (Extracto del manual oficial de PHP)

Un error de seguridad cometido con frecuencia en este punto es darle permisos de administrador (root) a apache, o incrementar las habilidades del usuario de apache de alguna otra forma.  
Incrementar los permisos del usuario de Apache hasta el nivel de administrador es extremadamente peligroso y puede comprometer al sistema entero, así que el uso de entornos sudo, chroot, o cualquier otro mecanismo que sea ejecutado como root no debería ser considerado como una opción por aquellos que no son profesionales en seguridad.  
Existen otras soluciones más simples. Mediante el uso de open_basedir se puede controlar y restringir qué directorios pueden ser usados por PHP. También se pueden definir áreas solo-Apache, para restringir todas las actividades basadas en web a archivos que no son de usuarios o del sistema.  
La mejor solucion de todas siempre será restringir todo y habilitar solo lo que se puede hacer.  

### Byte nulo
Muchos hackers usan el truco del byte nulo \0 para cortar la cadena donde ellos desean.  
Cuando un string se manda con byte nulo algunas funciones (las de archivo por ejemplo) que usan internamente funciones de c cortan los strings cuando detectan un byte nulo.  

Ejemplo de codigo vulnerable:  

    <?php
    $file = $_GET['file']; // "../../etc/passwd\0"
    if (file_exists('/home/wwwrun/'.$file.'.php')) {
        // file_exists devolverá true si el archivo /home/wwwrun/../../etc/passwd existe
        include '/home/wwwrun/'.$file.'.php';
        // el archivo /etc/passwd se incluirá
    }
    ?>

## Buenas prácticas de seguridad

* Utilizar usuarios con derechos personalizados para cada tarea nunca un super usuario o el propietario de la base
* Si es posible utilizar SSL/SSH entre la conexión del cliente PHP con la Base de datos
* [Encriptar datos sensibles con PHP antes de insertarlos en la base](Informatica/Seguridad/Encriptacion%20de%20datos.md)
* Inyección SQL: Una tecnica muy usada por los hackers es enviar luego de su consulta -- lo que indica un comentario en SQL y es para invalidar lo que esté despues en la consulta del sistema.
* Usar sentencias preparadas con variables vinculadas (PDO)
* Revisar siempre (en todos los casos no solo en la entradas a base de datos) que los datos enviados por el usuario corresponden con lo que se espera.
* Revise si la entrada proporcionada tiene el tipo de datos que se espera. PHP tiene un rango amplio de funciones para validar la entrada de datos, desde las más simples encontradas en Funciones de variable y en Funciones de tipo Caracter (Ej. is_numeric(), ctype_digit() respectivamente) y siguiendo el apoyo con las Expresiones regulares compatibles con Perl. 
* Si la capa de la base de datos no admite variables vinculadas, entrecomille cada valor no numérico proporcionado por el usuario que sea pasado a la base de datos con la función de escapado de cadenas de caracteres específica de la base de datos (p.ej. mysql_real_escape_string(), sqlite_escape_string(), etc.). Las funciones genéricas como addslashes() son útiles solamente en un entorno muy específico (p.ej., MySQL en un conjunto de caracteres monobyte con NO_BACKSLASH_ESCAPES deshabilitada), por lo que es mejor evitarlas.
* No muestre ninguna información específica de la base de datos, especialmente sobre el esquema, por su correcto significado es como jugar sucio contra usted mismo. Vea también Reporte de errores y Manejo de errores y funciones de registro.
* Podría utilizar procedimientos almacenados y previamente cursores definidos, para abstraer el acceso a datos para que los usuarios no tengan acceso directo a las tablas o vistas, para que esta solución tenga otros impactos. 
* Manejo de errores: En producción y en desarrollo el nivel de errores mostrados al usuario debe ser distinto. Si se muestran detalles de errores en producción esto puede ser utilizado por el atacante para conseguir información sobre el sistema.
* Register globals: Register Globals debe estar en off. Desde PHP 4 viene desactivada por defecto y a partir de 5.3 se elimina esta directiva. Lo que hace es inicializar las variables que son enviadas por el usuario lo cual es un problema de seguridad grande.
* Magic_quotes: Cuando están habilitadas, todos los caracteres ' (comillas simples), " (comillas dobles), \ (barras) y NULL son "escapados" automáticamente con una barra. Este comportamiento es equivalente al de la función addslashes(). 
Sin embargo ya no se utiliza. Penalizan el rendimiento, reducen la portabilidad del codigo y a veces generan errores porque escapan cosas que no se debian escapar.
* Ocultar PHP: No es tan eficiente pero ayuda. La idea es con .htaccess ocultar la extensión PHP o reemplazarla por otra a fin de que el atacante no sepa que tipo de lenguaje está detras del sitio.


