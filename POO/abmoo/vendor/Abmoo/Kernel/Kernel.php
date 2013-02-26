<?php

/**
* Kernel
*/
namespace Abmoo\Kernel;

use Abmoo\Kernel\WebResponse;
use Abmoo\Kernel\WebRequest;

use Abmoo\DependencyInjection\DependencyInjectionContainer;

use Abmoo\EventDispatcher\EventDispatcher;

class Kernel
{

	private $env; // Enviroment
	private $config; // Configuration
	private $container; // Dependency injection container
	private $eventDispatcher; // Disparador de eventos

	
	public function __construct($env, $config)
	{
		// Enviroment
		$this->env = $env;

		// Configuration
		$this->config = $config;

		// Dependency injection container (DIC)
		$this->container = new DependencyInjectionContainer($this->config['services']);

	}

	public function handle(WebRequest $request) 
	{
		/*** Proceso principal del sistema ****/
		try {

			$ed = $this->container->get('events.dispatcher');

			// Conecta un evento con un servicio de listener
			$ed->connect('kernel.request','events.listeners.test');

			$ed->notify('kernel.request', array('paramdeprueba' => true));

			$response = new WebResponse();

			$ed->notify('kernel.response');

			return $response;


		} catch(\Exception $e) {

			die('Error: '.$e->getMessage().' <br/>');
		}

	}


	public function getEnviroment() 
	{
		return $this->env;
	}

	public function getConfig($key = null)
	{
		if ($key === null) {
			return $this->config;
		} else {
			return $this->config[$key];
		}
	}
}
