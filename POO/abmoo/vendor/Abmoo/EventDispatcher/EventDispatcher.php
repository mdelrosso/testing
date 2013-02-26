<?php

/**
* 
*/
namespace Abmoo\EventDispatcher;

class EventDispatcher
{

	private $container;
	private $listeners = array();
	
	public function __construct($container)
	{
		echo 'Construction de event dispatcher<br/>';
		$this->container = $container;
	}


	public function notify($event, $params=array()) 
	{
		echo 'Notifica el evento:'.$event.'<br/>';

		// Busca listeners asociados
		if ( isset($this->listeners[$event]) ) {

			foreach ($this->listeners[$event] as $listener) {
				
				$this->container->get($listener[0])
					->$listener[1]($params);

			}

		}

		return $this;
	}


	public function connect($event, $listenerServiceId, $method = null)
	{

		if ($method == null) {
			$method = $this->getMethodFromEvent($event);
		}

		if ( !isset($this->listeners[$event]) ) {
			$this->listeners[$event] = array();
		}

		array_push($this->listeners[$event], array($listenerServiceId, $method) );

		return $this;
	}

	/** 
	 * Obtiene el nombre del metodo a utilizar 
	 * en el listener en base al nombre del evento
	 */
	private function getMethodFromEvent($event)
	{
		// Convierte . en espacio
		$event = str_replace('.', ' ', trim($event));

		// Capitaliza las primeras letras de las primeras palabras
		$event = ucwords($event);

		// Elimina los espacios
		$event = str_replace(' ', '', $event);

		return 'on'.$event;
	}
}