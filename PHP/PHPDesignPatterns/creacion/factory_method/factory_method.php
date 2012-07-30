<?php header('Content-type: text/html; charset=utf-8');


/*
 * PATRÓN: 
 * factory method (También conocido como Virtual constructor)
 * 
 * CATEGORIA: 
 * Patrón de creación
 * 
 * DESCRIPCION: 
 * Define una interfaz para crear un objeto pero deja que sean las subclases quienes decidan que clase de instanciar.
 * Permite que una clase delegue en sus subclases la creación de objetos.
 * Es un caso especial de abstract factory.
 *
 * USO: 
 * Se usa generalmente para crear frameworks. En las clases abstractas se guardan todas las operaciones comunes a cualquier tipo de objeto que 
 * se podria crear con el framework y se deja a las subclases la responsabilidad de implementar los métodos especificos.
 *
 * EXPLICACION: 
 * Al igual que los otros patrones de creación, la factoria elimina la necesidad de ligar nuestra aplicación a clases específicas dentro del código 
 * ya que mientras respeten la misma interfaz se podrán cambiar las clases originales y la aplicación seguiría funcionando sin problemas.
 * 
 * 
 * Fuentes:
 *   - http://www.dofactory.com/Patterns/PatternFactory.aspx
 *   - http://www.fluffycat.com/PHP-Design-Patterns/
 *   - http://www.oodesign.com/factory-method-pattern.html
 */



// --- Clases base (Guardan las operaciones comunes a cualquier tipo de objeto) ---

// Define una interfaz a utilizar por todos los tipos de documentos que genera la aplicacion
abstract class document {
	
	abstract function open();
	abstract function close() ;
	abstract function save();
	abstract function show();
	
}

abstract class application {
	
	// Template method: Este método ejecuta las acciones que son comunes a todos los tipos de documentos
	public function newDocument() {
		$doc = $this->factoryMethod(); 
		$doc->open();
		$doc->show();
	}
	
	// Factory method: Este método debe ser reescrito por sus subclases para devolver el tipo de documento asociado a la aplicacion
	abstract function factoryMethod();
}


// --- Clases concretas ---
class imageDocument extends document 
{
	public function open()
	{
		echo 'Open image document<br/>';
	}
	
	public function close()
	{
		echo 'Close image document<br/>';
	}
	
	public function save()
	{
		echo 'Save image document<br/>';
	}
	
	public function show()
	{
		echo 'Show image document<br/>';
	}
}


class imageApplication extends application 
{
	public function factoryMethod() {
		return new imageDocument();
	}

}

// Test
$app = new imageApplication();
$app->newDocument();




?>