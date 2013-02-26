<?php

/**
 * 
 */
namespace Abmoo\DependencyInjection;

class TestService
{
	
	private $entorno;
	private $dependence;
	private $debug;


	public function __construct($entorno, $debug, $dependence)
	{
		
		$this->entorno = $entorno;
		$this->debug = $debug;
		$this->dependence = $dependence;
	}

	public function test()
	{
		
		return 'Service ok! | '.$this->dependence->test();
	}
}