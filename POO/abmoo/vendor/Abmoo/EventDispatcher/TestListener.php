<?php


namespace Abmoo\EventDispatcher;

class TestListener
{
	
	public function __construct()
	{
	
	}


	public function onKernelRequest($params=array())
	{
		echo 'Ejecuta codigo asociado al evento kernel.request<br/>';
		echo 'Parametros pasados al evento: '. print_r($params,true).'<br/>';
	}
}