<?php

/**
* 
*/
namespace Abmoo\Kernel;

class WebResponse
{
	
	public function __construct()
	{
		//echo 'New webResponse created from Request<br/>';
	}

	public function send()
	{
		echo 'Hola Mundo soy una respuesta!<br/>';
	}

}