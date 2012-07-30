<?php  header('Content-type: text/html; charset=utf-8');

/*
 * PATRÓN: 
 * singleton
 * 
 * CATEGORIA: 
 * Patrón de creación
 * 
 * DESCRIPCION: 
 * Garantiza que una clase tenga una sola instancia y proporciona un punto de acceso global a ella
 *
 * USO: 
 * Se utiliza para objetos que deben ser únicos en un sistema. EJ: Un sistema puede tener muchos objetos "Impresora" pero debe existir solo una  "Cola de impresión"
 * Tambien se usa cuando se desea controlar o restringir el acceso de ciertos clientes al objeto.
 * Se podria implementar guardando el objeto en una variable global pero esto no restringiria que se creen mas copias de dicho objeto.
 *
 * EXPLICACION: 
 * El patron singleton es una mejora sustancial al uso de variables globales en los sistemas.
 * Se puede incluso controlar la cantidad de instancias de la clase singleton, en caso de que se requieran mas de una. 
 * Esto último solo se puede realizar si no se implementa mediante clases estáticas
 * El constructor se debe declarar privado para evitar que se puedan crear instancias de la clase singleton.
 * 
 * Fuentes:
 *   - http://www.dofactory.com/Patterns/PatternSingleton.aspx
 *   - http://www.fluffycat.com/PHP-Design-Patterns/Singleton/
 *   - http://www.oodesign.com/singleton-pattern.html
 */

// Singleton implementado mediante una clase comun
class configuration {
	
	
	private static $instance = NULL;
	private $configurations = array();
	
	// Se declara como private para garantizar que no se pueda construir mediante new
	private function __construct() 
	{
	  
	}
	
	// Metodo de creacion/acceso a la instancia única
	// En este método es donde se podrían centralizar las restricciones sobre la creación del objeto
	public static function getInstance() 
	{
		if (self::$instance == NULL) { 
			self::$instance = new configuration(); 
		} 
		return self::$instance;
	}

	// Metodos del objeto **Esto puede variar según el objeto que sea***
	public function set($key,$value) 
	{
		$this->configurations[$key] = $value;
	}
	
	public function get($key) 
	{
		return $this->configurations[$key];
	}

}

// TEST singleton con clase estatica
echo 'Testeo de singleton con clase comun<br />';
// El método getInstance es el único estático los demas no
$config = configuration::getInstance();
$config->set('cache','on');
echo $config->get('cache').'<br />';

// Si se intenta crear una clase con new tira error. Descomentar para testear
//$config = new configuration();


// Singleton implementado mediante una clase estatica
// En este caso no existe un metodo getInstance porque al ser estática es seguro que solo se puede acceder a una copia del objeto.
class configuration_static {
	
	
	private static $instance = NULL;
	private static $configurations = array();
	
	private function __construct() 
	{
	  
	}
	
	public static function set($key,$value) 
	{
		self::$configurations[$key] = $value;
	}
	
	public static function get($key) 
	{
		return self::$configurations[$key];
	}

}


// TEST singleton con clase estatica
echo 'Testeo de singleton con clase estatica<br />';
configuration_static::set('cache','on');
echo configuration_static::get('cache');

?>