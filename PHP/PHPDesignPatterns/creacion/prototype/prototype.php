<?php header('Content-type: text/html; charset=utf-8');
/*
 * PATRÓN: 
 * prototype
 * 
 * CATEGORIA: 
 * Patrón de creación
 * 
 * DESCRIPCION: 
 * Especifica los tipos de objetos a crear por medio de una instancia prototípica y crea nuevos objetos copiando dicho prototipo
 *
 * USO: 
 * Se usa cuando se necesitan crear objetos complejos o con muchas propiedades pero que varian muy poco entre si.
 * Tambien se usa para disminuir la cantidad de subclases
 *
 * EXPLICACION: 
 * Basicamente es una forma de crear objetos a travez de una copia o prototipo en vez de hacerlo a travez de la instanciación de una clase concreta.
 * Esto puede ser muy util cuando se necesitan crear muchos objetos de la misma clase pero con minimas variaciones en sus propiedades ya que 
 * se podria crear un protoipo generico y luego clonarlo y modificar algunas propiedades.
 * Para poder realizar la clonacion los objetos deben tener un metodo clone() que devulve una copia exacta de si mismo
 * PHP implementa el constructor "clone" en lugar de "new" para clonar objetos. 
 * Este constructor permite clonar exactamente todo el objeto y sus propiedades con la unica salvedad que todas aquellas propiedades que representen
 * referencias a otros objetos o variables seguieran siendo referencias.
 * Dentro de la clase se puede definir un metodo magico __clone() que se ejecutará luego de la clonación, lo cual hace sencilla la inicializacion
 * del objeto clonado
 * 
 * Fuentes:
 *   - http://www.dofactory.com/Patterns/PatternPrototype.aspx
 *   - http://www.fluffycat.com/PHP-Design-Patterns/Prototype/
 *   - http://www.oodesign.com/prototype-pattern.html
 */
 
 
class libreria 
{
	private $nombre = '';
	
	public function getNombre() 
	{
		return $this->nombre;
	}
	
	public function setNombre($nombre=NULL)
	{
		$this->nombre = $nombre;
	}
}

 
class prototipoLibro
{
	
	private $titulo = '';
	private $autor = '';
	private $libreria = '';

    function __construct() 
	{
    }

	public function setTitulo($newTitulo=NULL)
	{
		$this->titulo = $newTitulo;
	}
	
	public function getTitulo()
	{
		return $this->titulo;
	}
	
	public function setAutor($newAutor=NULL)
	{
		$this->autor = $newAutor;
	}
	
	public function getAutor()
	{
		return $this->autor;
	}
	
	
	public function setLibreria($newLibreria=NULL)
	{
		$this->libreria = $newLibreria;
	}
	
	public function getLibreria()
	{
		return $this->libreria;
	}

	public function showDatos() 
	{
		echo "Titulo: ".$this->titulo.'<br /> Autor: '.$this->autor.' <br /> Libreria: '.$this->libreria->getNombre().'<br />';
	}
	
	// Metodo magico. Luego de clonar debe inicializar el autor y el titulo pero no la libreria
    function __clone() 
	{
    	$this->autor='';
		$this->titulo='';
	}
}


// Test

// Crea la libreria
$libreria = new libreria();
$libreria->setNombre('Yenny');

// Crea el prototipo de libro para luego crear los libros de la libreria a partir de él
$protoLibro = new prototipoLibro();
$protoLibro->setLibreria($libreria);

$libro1 = clone $protoLibro;
$libro1->setTitulo('La biblia de PHP');
$libro1->setAutor('Zend enterprises');
$libro1->showDatos();
echo '<br /><br />';

// Al cambiar algun dato de la libreria se puede ver que los datos se actualizan en los objetos clonados. 
// Esto es porque si bien los objetos se clonan la referencia se mantiene.
// Cuando se clona un libro que referencia a la libreria, se clonan solo las propiedades directas del libro pero la referencia se mantiene
$libreria->setNombre('Ateneo');

$libro1 = clone $protoLibro;
$libro1->setTitulo('La biblia de Mysql');
$libro1->setAutor('Apache technologies');
$libro1->showDatos();
 

?>