<?php 

// Prueba ejecución de metodos dinamicamente
class tpvbooking {

	// Public
	public $config = array();
	public $debugmode = false;
	
	// Private
	private $schema = array();
	
	function frontControl($MethodName,$Arguments) {
			// Obtiene configuración principal
			echo 'Obtiene configuración principal <br>';
			
			// Obtiene esquema de la acción a ejecutar
			/*Esto permite saber como manejar la petición*/
			echo 'Obtiene esquema para acción '.$MethodName.' <br>';
			
			// Ejecuta procesos generales previos a la acción
			echo 'Ejecuta procesos generales <br>';
	}
	
	
	
	// Métodos dinámicos no declarados. Se ejecuta ante cualquier método pedido a la clase que no exista
	function __call($MethodName, $Arguments) {
		$this->frontControl($MethodName,$Arguments);
		
		// Valida métodos aceptados (estos datos los obtiene del esquema)
		$AcceptedMethods = array(
			'getHotels',
			'getRates',
			'getPepes'
		);
		if(!in_array($MethodName, $AcceptedMethods)) {
		  trigger_error("Method <strong>$method_name</strong> no existe", E_USER_ERROR);
		}
		return $this->executeAction($MethodName,$Arguments);
	}


	// ------------------ Métodos dinámicos ------------------
	public function executeAction($ActionName,$Params) {
		echo 'Ejecuto la accion: '.$ActionName.'<br>';
		print_r($Params);
		echo '<br><br>';
	}
	
	
	// ------------------ Métodos estáticos ------------------
	
	// Ejemplo de función local con controlador frontal
	public function dump($array=array(),$title='') {
		$this->frontControl('dump',array());
		
		echo "<div style=\"margin:5;padding:10;border:1px solid black;background:#FFFF00;color:black;\">"; 
		if ($title){ echo "<h3>{$title}</h3>";	}	
		echo "<pre>";	print_r($array);	
		echo "</pre>"; 	echo "</div>"; 
	}
	
	// Ejemplo de funcion local sin controlador frontal
	public function dump2($texto) {
		echo $texto.'<br>';
	}
}


$tpv = new tpvbooking();
$tpv->getHotels('asadasdadafa');
$tpv->getRates('asffdf',5);
$tpv->dump(array('pepe','pupo'),'prueba de dump');
$tpv->dump2('Holaaa');
$tpv->getPepes('Parametro de lka funcion pepe');





?>