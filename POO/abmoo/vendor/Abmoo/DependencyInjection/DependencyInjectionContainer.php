<?php

/**
*  Contenedor de dependencias
*
*  
*/
namespace Abmoo\DependencyInjection;


class DependencyInjectionContainer
{

	/**
	 * Guarda las instancias de los servicios 
	 * ya creados con scope container 
	 */
	private $objects = array();

	// Guarda los parámetros globales para todo el contenedor
	private $parameters = array(); 

	// Guarda la descripción de los servicios
	private $services; 

	// Configuración por defecto para los servicios
	private $defaults = array(
		'arguments' => array(),
		'public' => true,
		'scope' => 'container'
	);


	
	public function __construct( $services = array() )
	{
		foreach ($services as $id => $description) {

			if ($id == 'parameters') {
				$this->addParameters($description);
			}


			$this->add($id, $description);
		}
		
	}


	/** 
	 * Gestión de parametros globales 
	 */
	public function addParameters($parameters = array() ) 
	{
		foreach ($parameters as $key => $value) {
			$this->addParameter($key, $value);
		}
	}


	public function addParameter($key, $value)
	{
		$this->parameters[$key] = $value;
	}


	public function getParameter($id, $default = null)
	{
		return ( isset($this->parameters[$id])  ) ? $this->parameters[$id] : $default;
	}



	/** 
	 * Gestión de servicios 
	 */
	public function add($id, $description = array())
	{
		$this->services[$id] = array_merge($this->defaults, $description);
	}


	public function remove($id)
	{
		unset($this->services[$id]);
	}


	public function has($id) 
	{
		return isset($this->services[$id]);
	}

	/** 
	 * Proceso principal que se encarga de obtener los servicios
	 */
	public function get($id)
	{

		/*** Comprueba si existe el servicio ***/
		if ( !isset($this->services[$id]) ) {
			throw new \Exception(sprintf('Service "%s" is not defined.', $id));
		}

		$s = $this->services[$id];

		/*** Comprueba si puede ser obtenido desde afuera ***/
		if (!$s['public']) {
			throw new \Exception(sprintf('Service "%s" is private.', $id));
		}

		/*** Comprueba el scope ***/
		if (	 $s['scope'] != 'container' 
			  && $s['scope'] != 'prototype' 
			) {
			throw new \Exception(sprintf('Service "%s" scope is not a valid scope.', $id));
		}

		$s['arguments'] = $this->checkForDependences($id, $s['arguments']);

		// Same instance (Singleton)
		if ($s['scope'] == 'container') {

			/* 
			 * Comprueba si ya existe una instancia 
			 * del objeto creada y la devuelve
			 */
			if ( isset($this->objects[$id]) ) {

				return $this->objects[$id];

			} else {

				$this->objects[$id] = $this->classBuilder($s['class'], $s['arguments']);

				return $this->objects[$id];
			}

		}
		// New instance of the service
		else if($s['scope'] == 'prototype') {
			return $this->classBuilder($s['class'], $s['arguments']);
		} 
		
	}




	// Abstrae el proceso de creación de una clase
	private function classBuilder($class, $args = array() )
	{

		// Complex class creation with construction arguments
		if ( !empty($args) ) {

			// Use reflection to pass arguments to the class constructor
			$reflection = new \ReflectionClass($class);
	    
	    	$obj = $reflection->newInstanceArgs($args);
		} 
		// Simple class creation (without arguments)
		else {
			$obj = new $class;
		}

		return $obj;
	}

	/**  
	 * Recibe el id del servicio y los argumentos, 
	 * Obtiene las dependencias y las reemplaza en los 
	 * argumentos
	 */
	private function checkForDependences($id, $args)
	{


		foreach ($args as $k => $arg) {

			if ( is_string($arg) ) {

				if ( substr($arg ,0, 1) == '@') {

					//echo 'dependencia!'.$k.' '.$arg.'<br/>';
					//echo 'id dependencia: '. substr($arg ,1, strlen($arg)).'!<br/>';
					
					$depId = substr($arg ,1, strlen($arg));

					// Comprueba si la dependencia es el propio contenedor
					if ($depId == 'container') {

						$args[$k] = $this;
						
					} else {

						// Comprueba referencia circular
						if ( $this->checkForCircularReference($id, $depId) ) {
							throw new \Exception( sprintf('Circular reference detected on %s',$depId) );
						}

						// Obtiene la dependencia y reemplaza el parámetro por el objeto instanciado
						$args[$k] = $this->get($depId);	

					}

					
				}

			}
			
		}

		return $args;
			
	}

	/**
	 * Chequea referencia cirular entre dos servicios
	 * Si existe devuelve true de lo contrario false
	 */
	private function checkForCircularReference($idService1, $idService2)
	{

		// Referencia a si mismo
		if ($idService1 == $idService2) {
			return true;
		}

		/**
		 * Referencia circular
		 */
		// Obtiene las dependencias del primer servicio
		$deps1 = $this->getDependences($idService1);
		
		// Obtiene las dependencias del segundo servicio
		$deps2 = $this->getDependences($idService2);

		if ( in_array($idService2, $deps1) && in_array($idService1, $deps2) ) {
			return true;
		}


		return false;

	}

	// Obtiene un array con las dependencias de un servicio
	private function getDependences($serviceId)
	{
		$deps = array();

		foreach ($this->services[$serviceId]['arguments'] as $k => $arg) {

			if ( is_string($arg) ) {

				if ( substr($arg ,0, 1) == '@') {

					$depId = substr($arg ,1, strlen($arg));

					array_push($deps, $depId);

				}

			}
			
		}

		return $deps;
	}



}

