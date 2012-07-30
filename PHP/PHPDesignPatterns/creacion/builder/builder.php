<?php header('Content-type: text/html; charset=utf-8');
/*
 * PATRÓN: 
 * builder - Constructor
 * 
 * CATEGORIA: 
 * Patrón de creación
 * 
 * DESCRIPCIÓN: 
 * Separa la construcción de un objeto complejo de su representación, de forma que el mismo proceso de construcción pueda crear diferentes representaciones
 * Este patrón no es otra cosa que un separador de datos y presentación pero orientado a la creación de objetos complejos.
 *
 * USO: 
 * Se utiliza cuando con los mismos datos o el mismo conjunto de objetos se deben construir diferentes estructuras
 * 
 * EXPLICACIÓN: 
 * Para entender bien este patron se debe comprender que rol juega cada objeto. 
 * Los objetos intervinientes son: el director, los constructores y los productos.
 *
 * El director es quien tiene las partes a representar, pero no conoce ni le interesa como se representan. 
 * El constructor toma los comandos ejecutados por el director que le sirven para construir el objeto que tiene asignado e ignora los que no necesita.
 * Todos los constructores comparten la misma interfaz hacia el director, aunque seguramente algunos de los metodos serán implementados solo para respetar la interfaz pero no tendran implementacion concreta.
 * Los productos son aquellos que conocen la representacion y son los encargados de tomar los datos pasados por el constructor, representarlos de la manera que conocen y devolver el resultado al mismo.
 *
 * El ejemplo mas claro de uso de este patrón se da al intentar representar una serie de datos en dos formatos diferentes, por ejemplo XML y HTML.
 * Los datos (el título de la pagina, el header, el contenido, etc) son pasados por el director al constructor correspondiente que se encargara de formatearlos de
 * la manera apropiada y devolvera el resultado al director.
 *
 * Claves:
 * 1) El director ejecuta todos los comandos sin importar que tipo de constructor reciba, es el constructor quien filtra lo que no le sirve
 * 2) Todos los constructores respetan la misma interfaz
 * 3) Los constructores sirven como adaptadores de los productos hacia el director porque gracias a ellos el director no debe conocer la interfaz de cada producto concreto
 * 4) Los productos son los verdaderos conocedores de la representacion final
 * 
 * FUENTES:
 *   - http://www.dofactory.com/Patterns/PatternBuilder.aspx
 *   - http://www.fluffycat.com/PHP-Design-Patterns/Builder/
 *   - http://www.oodesign.com/builder-pattern.html
 */
 

// Objetos concretos que reciben los datos y los ubican dentro de la estructura o la representacion
class HTMLPage {

    private $page = NULL;

    private $page_title = NULL;
    private $page_heading = NULL;
    private $page_text = NULL;

    function __construct() {
    }

    function showPage() {
      return $this->page;
    }

    function setTitle($title_in) {
      $this->page_title = $title_in;
    }

    function setHeading($heading_in) {
      $this->page_heading = $heading_in;
    }

    function setText($text_in) {
      $this->page_text .= $text_in;
    }

    function formatPage() {
       $this->page  = '[html]';
       $this->page .= 
          '[head][title]'.$this->page_title.'[/title][/head]';
       $this->page .= '[body]';
       $this->page .= '[h1]'.$this->page_heading.'[/h1]';
       $this->page .= $this->page_text;
       $this->page .= '[/body]';
       $this->page .= '[/html]';
    }

  }

/*
 * A diferencia de HTMLPage este tipo de pagina tiene el title incluido en el texto e ignora el heading
 * En definitiva usa los mismos datos pero cambia la relacion entre ellos y por lo tanto su representación
 *
 */
class XMLPage {
	private $page = NULL;

	private $page_title = NULL;
    private $page_text = NULL;

    function __construct() {
    }

	function setTitle($title_in) {
      $this->page_title = $title_in;
    }

    function showPage() {
      return $this->page;
    }

    function setText($text_in) {
      $this->page_text .= $text_in;
    }

    function formatPage() {
       $this->page  = '[xml title="'.$this->page_title.'"]';
	   $this->page .= $this->page_text;
       $this->page .= '[/xml]';
    }
}


// Clase abstracta encargada de definir la interfaz de todos los objetos constructores especificos
abstract class AbstractPageBuilder {
    abstract function getPage();
}

// Clase concreta que construye un objeto concreto (En este caso una pagina html) 
class HTMLPageBuilder extends AbstractPageBuilder {

    private $page = NULL;

    function __construct() {
      $this->page = new HTMLPage();
    }

    function setTitle($title_in) {
      $this->page->setTitle($title_in);
    }

    function setHeading($heading_in) {
      $this->page->setHeading($heading_in);
    }

    function setText($text_in) {
      $this->page->setText($text_in);
    }

    function formatPage() {
      $this->page->formatPage();
    }

    function getPage() {
      return $this->page;
    }

  }


/*
 * Clase concreta que construye un objeto concreto (En este caso un xml) 
 * Si bien el XML no tiene heading debe mantener un método setHeading para poder ser compatible con un director generico 
 * tanto para HTML como para XML
 */
class XMLPageBuilder extends AbstractPageBuilder {

    private $page = NULL;

    function __construct() {
      $this->page = new XMLPage();
    }

    function setTitle($title_in) {
	  $this->page->setTitle($title_in);
    }

	// Este metodo es la calve por la cual se debe construir un builder.
    function setHeading($heading_in) {
      
    }
	
    function setText($text_in) {
      $this->page->setText($text_in);
    }

    function formatPage() {
      $this->page->formatPage();
    }

    function getPage() {
      return $this->page;
    }

  }


// Clase encargada de definir la interfaz utilizada por el director
abstract class AbstractPageDirector {

	abstract function __construct(AbstractPageBuilder $builder_in);

	abstract function buildPage();

	abstract function getPage();

 }


/* Clase concreta que se encargará de utilizar el objeto builder pasado para construir una pagina
 * Este objeto es el que conoce los datos que se cargarán en el documento ejecutará todo los métodos sin importar que el producto que desea obtener no lo acepte.
 * Ej: Un XML no contiene un heading por lo cual si se utiliza un constructor xml se ignorará esta peticion
 * 
 * Si los constructores no comparten la misma interfaz se debería crear un director específico llamado xmlPageDirector y otro htmlPageDirector
 * y por lo tanto se deberá instanciar uno u el otro según se quiera crear una pagina HTML o XML respectivamente
 */ 
class pageDirector extends AbstractPageDirector {

    private $builder = NULL;

    public function __construct(AbstractPageBuilder $builder_in) {
	     $this->builder = $builder_in;
    }

    public function buildPage() {
      $this->builder->setTitle('Testing the HTMLPage');
      $this->builder->setHeading('Testing the HTMLPage');
      $this->builder->setText('Testing, testing, testing!');
      $this->builder->setText('Testing, testing, testing, or!');
      $this->builder->setText('Testing, testing, testing, more!');
      $this->builder->formatPage();
    }

    public function getPage() {
      return $this->builder->getPage();
    }

  }
 

// --- Test ---
echo '--- HTML ---<br/>';
// El director necesita de un constructor que genere la pagina ya que él solo conoce los datos que se incluiran dentro y no su estructura
$pageDirector = new pageDirector(new HTMLPageBuilder());
$pageDirector->buildPage();
$page = $pageDirector->GetPage();
echo $page->showPage();

echo '<br/><br/>--- XML ---<br/>';
$pageDirector = new pageDirector(new XMLPageBuilder());
$pageDirector->buildPage();
$page = $pageDirector->GetPage();
echo $page->showPage();

// Como se puede ver en el testeo sólo se cambio el constructor y no hubo necesidad de cambiar otra cosa para que el resultado cambie de un html a un xml.


?>