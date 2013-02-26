<?php

/**
* WebRequest class
* 
* Singleton
*/
namespace Abmoo\Kernel;


	class WebRequest 
	{

		private static $instance = null;
		
		/**
		 * Permite asegurar que no se pueda 
		 * crear una instancia con new
		*/
		private function __construct() {}
		

		/**
		 * Crea una nueva instancia de webRequest 
		 * y la rellena con datos globales provistos
		 * por PHP
		 */
		private static function createFromGlobals()
		{
			
			self::$instance = new self();
			//echo 'New Web request created from globals<br/>';
			return self::$instance;
		}


		/**
		 * Devuelve una unica instancia de la clase
		 * Si no está creada la crea por primera vez
		 */
		public static function getInstance()
		{
			if (self::$instance === null) {
				return self::createFromGlobals();
			} else {
				return self::$instance;
			}
		}


		
	}