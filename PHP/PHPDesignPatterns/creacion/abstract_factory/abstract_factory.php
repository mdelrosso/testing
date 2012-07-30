<?php header('Content-type: text/html; charset=utf-8');
/*
 * NOMBRE DEL PATRON: 
 * abstract factory (Tambien conocido como Kit)
 * 
 * CATEGORIA: 
 * Patrón de creación
 * 
 * DESCRIPCION: 
 * Proporciona una interfaz para crear objetos y familias de objetos relacionados o que dependen entre si sin especificar los nombres de sus clases concretas
 *
 * USO: 
 * Se usa principalmente para permitirle a una aplicación sustituir los objetos que utiliza por otros, sin que esto requiera cambiar en el código fuente los nombres de las clases a instanciar.
 * Tambien se utiliza para simplificar la creación de objetos complejos
 * 
 * EXPLICACION: 
 * El objetivo principal de una factoría es "ocultar al programa el verdadero nombre del objeto".
 *
 * Supongamos que una aplicación utiliza un motor de plantillas (Ej: Smarty Templates). 
 * En el código fuente de la misma se encontrarán comandos como el siguiente: "$smarty = new SmartyClass($options);"
 * Estos comandos si bien son correctos no representan una buena práctica en cuanto a reutilización ya que si 
 * en algun momento se decide cambiar de motor de plantillas habrá que reemplazar todo lo relacionado a Smarty en 
 * la aplicación. 
 * Si utilizaramos un comando como el siguiente: * "$templatesObject = templateObjectsFactory()->getTemplatesObject()"
 * el cual utiliza un "objeto intermediario" encargado de instanciar el objeto concreto de templates (en este caso smarty), podriamos modificar fácilmente
 * el objeto de templates que usa toda la aplicación, con solo tocar una linea de código dentro del objeto templateObjectsFactory.
 *
 * Las clases que heredan de la factoria abstracta son las que se instancian en la aplicación y las que usa el cliente.
 * En realidad casi siempre la aplicación utilizará solo una de ellas que dependerá de una configuración que establezca el usuario o estará fija en el código fuente escrito por el programador.
 * Suele implementarse utilizando el patrón singleton ya que no tiene sentido instanciar 2 veces la misma factoria
 *
 * Hay varias maneras de implementar las factorias y se diferencian principalmente en como se arman las clases principales que serán utilizadas por el cliente. 
 *
 * En el ejemplo básico que aparece siempre para explicar el patrón "abstract factory" se usa la combinación de una clase factoria abstracta junto con 
 * sus diferentes subclases que representan cada una de las familias de objetos relacionados y cada una de ellas contiene dentro un método para 
 * cada objeto que instancia.
 * Esto suele servir solo para casos en los que no se necesite ampliar la cantidad de tipos de objetos que puede crear la factoria pero si bien es la 
 * opción mas segura no es la más flexible ya que cualquier mínimo cambio requerirá modificar varias partes del código fuente.
 *
 * En otros casos en los cuales los objetos a crear pueden crecer con el tiempo se utiliza una clase factory con un método crearInstancia($tipo) al cual se le 
 * pasa como parámetro el tipo de objeto a crear con lo cual solo resta actualizar este metodo si se desea que la factoria acepte nuevos tipos de objetos
 *
 * Para hacerlo aún más dinámico el método podria recibir ademas del tipo, otro parámetro con los datos asociados a ese tipo de objeto 
 * (como el nombre de la clase, y los parámetros de inicialización). Lo único que estará definido por la aplicación son los tipos de objetos soportados
 * pero ni sus clases ni los parámetros de inicialización estarán fijos en la misma sino que podrán ser especificados por el usuario
 * 
 * Fuentes:
 *   - http://www.dofactory.com/Patterns/Patterns.aspx
 *   - http://www.fluffycat.com/PHP-Design-Patterns/
 *   - http://www.oodesign.com/
 *
 */
 

$run = array(
	'fixed' => $_GET['type']=='fixed' ? true : false
	,'semiDynamic' => $_GET['type']=='semiDynamic' ? true : false
	,'dynamic' => $_GET['type']=='dynamic' ? true : false // Usado en Symfony
	,'fullDynamic' => $_GET['type']=='fullDynamic' ? true : false // Usado en Symfony
);
 
 
// --- Funciones usadas para todo el test ---
function writeln($line_in) {
	echo $line_in."<br/>";
}
// --- /Funciones usadas para todo el test ---


// --- Clases usadas en todos los tipos ---
/*
 * Book classes
 * 	Hay 2 tipos de libros: Los de PHP y los de MYSQL
 * 	AbstractMySQLBook: Clase abstracta de libros
 * 	AbstractPHPBook: 
 */


/*
 * Mysql Type
 */
abstract class AbstractMySQLBook {
    private $subject = "MySQL";
}

class OReillyMySQLBook extends AbstractMySQLBook {
	private $author;
	private $title;
	function __construct() {
		$this->author = 'George Reese, Randy Jay Yarger, and Tim King';
		$this->title = 'Managing and Using MySQL';
	}
	function getAuthor() {
		return $this->author;
	}
	function getTitle() {
		return $this->title;
	}
}

class SamsMySQLBook extends AbstractMySQLBook {
	private $author;
	private $title;
	function __construct() {
		$this->author = 'Paul Dubois';
		$this->title = 'MySQL, 3rd Edition';
	}
	function getAuthor() {
		return $this->author;
	}
	function getTitle() {
		return $this->title;
	}
}

/*
 * PHP Type
 */
abstract class AbstractPHPBook {
    private $subject = "PHP";
}

class OReillyPHPBook extends AbstractPHPBook {
	private $author;
	private $title;
	private static $oddOrEven = 'odd';
	function __construct()
	{
		//alternate between 2 books
		if ('odd' == self::$oddOrEven) {
			$this->author = 'Rasmus Lerdorf and Kevin Tatroe';
			$this->title = 'Programming PHP';
			self::$oddOrEven = 'even';
		}
		else {
			$this->author = 'David Sklar and Adam Trachtenberg';
			$this->title = 'PHP Cookbook';
			self::$oddOrEven = 'odd';
		}
	}
	function getAuthor() {
		return $this->author;
	}
	function getTitle() {
		return $this->title;
	}
}

class SamsPHPBook extends AbstractPHPBook {
	private $author;
	private $title;
	function __construct() {
		//alternate randomly between 2 books
		mt_srand((double)microtime() * 10000000);
		$rand_num = mt_rand(0, 1);

		if (1 > $rand_num) {
			$this->author = 'George Schlossnagle';
			$this->title = 'Advanced PHP Programming';
		}
		else {
			$this->author = 'Christian Wenz';
			$this->title = 'PHP Phrasebook';
		}
	}
	function getAuthor() {
		return $this->author;
	}
	function getTitle() {
		return $this->title;
	}
}
// --- /Clases usadas en todos los tipos ---
 
 
// ---------------------------------------- fixed: Ejemplo clásico de abstract factory ---------------------------------------- 
if ($run['fixed']) {

/*
 * Clase abstracta que solo define una interfaz y que en este caso solo sirve para restringirle a las subclases los métodos que pueden crear
 * Como se ve existe un método para cada tipo de objeto que puede crear la fábrica. Uno para libros PHP y otro para libros Mysql
 *
 * Si se quisiera agregar más tipos de objetos como por ejemplo un libro de ASP se debería modificar esta clase agregándole un método makeASPBook.
 * Además se deberían crear toda una nueva familia de productos: AbstractASPBook, OReillyASPBook, SamsASPBook y por supuesto una nueva fabrica ASPBookFactory
 */
abstract class AbstractBookFactory {
    abstract function makePHPBook();
    abstract function makeMySQLBook();
}


/*
 * Clases concretas que usará el cliente.
 * Una fábrica para los productos de Oreilly y otra para los productos de Sams
 * Una variable de configuración podria indicarle a la aplicación si debe instanciar una u otra familia de productos
 */
class OReillyBookFactory extends AbstractBookFactory {
	private $context = "OReilly";
	function makePHPBook() {
		return new OReillyPHPBook;
	}
	function makeMySQLBook() {
		return new OReillyMySQLBook;
	}
}

class SamsBookFactory extends AbstractBookFactory {
	private $context = "Sams";
	function makePHPBook() {
		return new SamsPHPBook;
	}
	function makeMySQLBook() {
		return new SamsMySQLBook;
	}
}


/*
 * Run Test
 */
writeln('--- Testing Fixed type ---');

writeln('testing OReillyBookFactory');
$bookFactoryInstance = new OReillyBookFactory;

$book = $bookFactoryInstance->makePHPBook();
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeMySQLBook();
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('');

writeln('testing SamsBookFactory');
$bookFactoryInstance = new SamsBookFactory;

$book = $bookFactoryInstance->makePHPBook();
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeMySQLBook();
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('--- Conclucion: Mismos objetos diferentes resultados ---');
writeln('--- /Testing Fixed type ---');

}
// ---------------------------------------- /fixed: Ejemplo clásico de abstract factory ---------------------------------------- 
 
 
 
 
 
// ---------------------------------------- semiDynamic: Ejemplo con metodo dinámico de creación pero con algunas restricciones (Para familias de objetos) ---------------------------------------- 
if ($run['semiDynamic']) {

/*
 * Clase abstracta, esta vez solo contiene un método genérico
 */
abstract class AbstractBookFactory {
    abstract function makeBook($type);
}


/*
 * Clases concretas que usará el cliente.
 * Una fábrica para los productos de Oreilly y otra para los productos de Sams
 * Una variable de configuración podria indicarle a la aplicación si debe instanciar una u otra familia de productos
 * Además se deberá especificar el tipo de libro a crear en cada creación EJ: $objFactory->makeBook('php');
 *
 * Cuando se usan factorias concretas como en este caso es porque se requiere elegir entre una familia de objetos u otra.
 * Cambiar de una factoria a la otra sugiere un cambio de una rama de objeto a otra diferente.
 * Cuando no se tienen familias de objetos relacionados sino objetos independientes entre si pero que se desean ocultar al cliente porque
 * podrían cambiar sus clases en un futuro se suele utilizar una variante más flexible llamada semiDynamic que se explica en el próximo ejemplo
 */
class OReillyBookFactory extends AbstractBookFactory {
	private $context = "OReilly"; // Esta variable es la que termina definiendo la familia de productos a usar
	function makeBook($type) { // Type define el tipo de producto dentro de la familia de productos que se debe crear
		if ($type=='php') return  new OReillyPHPBook;
		if ($type=='mysql') return  new OReillyMySQLBook;
	}
}

class SamsBookFactory extends AbstractBookFactory {
	private $context = "Sams";
	function makeBook($type) {
		if ($type=='php') return  new SamsPHPBook;
		if ($type=='mysql') return  new SamsMySQLBook;
	}
}


/*
 * Run Test
 */
writeln('--- Testing Dynamic type ---');

writeln('testing OReillyBookFactory');
$bookFactoryInstance = new OReillyBookFactory;

$book = $bookFactoryInstance->makeBook('php');
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeBook('mysql');
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('');

writeln('testing SamsBookFactory');
$bookFactoryInstance = new SamsBookFactory;

$book = $bookFactoryInstance->makeBook('php');
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeBook('mysql');
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('--- Conclucion: Mismos objetos diferentes resultados ---');
writeln('--- /Testing Dynamic type ---');

}
// ---------------------------------------- /semiDynamic: Ejemplo con metodo dinámico de creación pero con algunas restricciones (Para familias de objetos) ---------------------------------------- 



// ---------------------------------------- dynamic: Ejemplo con metodo dinamico de creacion con una sola clase factoria (Para objetos no relacionados) ---------------------------------------- 
if ($run['dynamic']) {

/*
 * Clase definitiva que será instanciada por el cliente. En este ejemplo no hay clases abstractas y concretas porque no existen objetos relacionados entre si
 * NOTA: Para no tener que crear diferentes tipos de objetos, reutilizaremos los de los ejemplos anteriores tomando como que son objetos distintos no relacionados.
 */
class AbstractBookFactory {
    public function makeBook($type) {
		if ($type=='phpOReilly') return  new OReillyPHPBook;
		if ($type=='mysqlOreilly') return  new OReillyMySQLBook;
		if ($type=='phpSams') return  new SamsPHPBook;
		if ($type=='mysqlSams') return  new SamsMySQLBook;
	}
}

/*
 * Run Test
 */
writeln('--- Testing Dynamic type ---');

writeln('testing OReillyBookFactory');
$bookFactoryInstance = new OReillyBookFactory;

$book = $bookFactoryInstance->makeBook('php');
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeBook('mysql');
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('');

writeln('testing SamsBookFactory');
$bookFactoryInstance = new SamsBookFactory;

$book = $bookFactoryInstance->makeBook('php');
writeln('php Author: '.$book->getAuthor());
writeln('php Title: '.$book->getTitle());

$book = $bookFactoryInstance->makeBook('mysql');
writeln('MySQL Author: '.$book->getAuthor());
writeln('MySQL Title: '.$book->getTitle());

writeln('--- Conclucion: Mismos objetos diferentes resultados ---');
writeln('--- /Testing Dynamic type ---');

}
// ---------------------------------------- /semiDynamic: Ejemplo dinámico pero con algunas restricciones (Para objetos no relacionados)---------------------------------------- 




// ---------------------------------------- fullDynamic: Ejemplo completamente dinámico (Usado en Frameworkos para reemplazar los objetos del mismo por otros) ---------------------------------------- 
if ($run['fullDynamic']) {

// Config file:
$config = array(
	/*
	 * logs será el nombre del objeto que usará la aplicación
	 * Si en algun momento se requiere usar otra clase diferentes se deberá sustituir la entrada phpLogClass por otraPhpLogClass
	 * Si la interfaz del otro objeto es la misma, la aplicación no notará el cambio. Incluso si es diferente se podria utilizar el patrón
	 * "adapter" para adaptarla y poder utilizarla de todas maneras
	 */
	'logs' => array(
		'class' => 'phpLogClass'
		,'params' => array('param1','param2','param3')
	)
	,'templates' => array(
		'class' => 'SmartyClass'
		,'params' => ''
	)
);

/*
 * Clase concreta, que contiene un método genérico con parámetros que definen su comportamiento
 */
class factory {
    function createInstanceOf($class,$params){
		return  new $class($params);
	}
}

/*
 * Clases 
 */
class phpLogClass {
	function getLog() {
		return 'Contenido del log';
	}

}

class otraPhpLogClass {
	function getLog() {
		return 'Contenido del log obtenido con la clase secundaria';
	}

}

class SmartyClass {
	function getTemplate() {
		return '<b>#Esto es un template#</b>';
	}
}


/*
 * Run Test
 */
writeln('--- Testing Full Dynamic type ---');

writeln('testing Logs');
$factoryInstance = new factory;
$logs = $factoryInstance->createInstanceOf($config['logs']['class'],$config['logs']['params']);
writeln($logs->getLog());

writeln('Cambio la configuración en tiempo de ejecución: Ahora la clase encargada de los logs será la secundaria');
$config['logs']['class'] = 'otraPhpLogClass';
$logs = $factoryInstance->createInstanceOf($config['logs']['class'],$config['logs']['params']);
writeln($logs->getLog());

writeln('testing Templates');
$templates = $factoryInstance->createInstanceOf($config['templates']['class'],$config['logs']['params']);
writeln($templates->getTemplate());

writeln('');

writeln('--- /Testing Full Dynamic type ---');

}
// ---------------------------------------- /dynamic:  Ejemplo completamente dinámico (Usado en Frameworkos para reemplazar los objetos del mismo por otros) ---------------------------------------- 


?>
