<?php

/****************************
 *  Configuración principal *
 ****************************/



// For all enviroments
$config['global'] = array();

	// Parámetros para toda la aplicación
	$config['global']['parameters'] = array(
	);

	/**************************************************************
	 * Services (Dependency injection container main configuration)
	 **************************************************************/
	$config['global']['services'] = array(

		// Parámetros globales para servicios
		'parameters' => array(
			'test' => 'Testing parameter ok!'
		),

		// Servicio de testeo
		'kernel.test' => array(
			'class' => 'Abmoo\DependencyInjection\TestService',
			'arguments' => array('Prod', true,'@kernel.dependence'),
			'public' => true,
			'scope' => 'container'
		),

		// Servicio de testeo para dependencia
		'kernel.dependence' => array(
			'class' => 'Abmoo\DependencyInjection\TestDependence',
			'arguments' => array(),
			'public' => true,
			'scope' => 'container'
		),

		// EventDispatcher
		'events.dispatcher' => array(
			'class' => 'Abmoo\EventDispatcher\EventDispatcher',
			'arguments' => array('@container'),
			'public' => true,
			'scope' => 'container'
		),

		// Listener de prueba
		'events.listeners.test' => array(
			'class' => 'Abmoo\EventDispatcher\TestListener',
			'arguments' => array(),
			'public' => true,
			'scope' => 'container'
		)

	);



// Develompent (dev)
$config['dev'] = array();

// Staging (stg)
$config['stg'] = array();

// Production (prod)
$config['prod'] = array();





// ---------- Dont edit below here ----------

// Final merge
$config['dev'] = array_merge($config['global'], $config['dev']);
$config['stg'] = array_merge($config['global'], $config['stg']);
$config['prod'] = array_merge($config['global'], $config['prod']);