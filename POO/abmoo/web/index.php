<?php

/* 
 * Boostrap 
 * Contiene todos los achivos de clases necesarios
 * para ejecutar cualquier request del sistema
 */
require_once __DIR__.'/../app/boostrap.php';

use Abmoo\Kernel\WebRequest;
use Abmoo\Kernel\Kernel;
use Abmoo\Utils\Utils;

// Entorno
$env = 'prod';

// El Kernel es el encargado de manejar toda la aplicación
$kernel = new Kernel($env, $config[$env]);

// /*DEBUG*/ Utils::dump( $kernel->getConfig() ,'Configuration');

// Se crea una nueva webRequest
$request = WebRequest::getInstance();

// El kernel procesa la request y devuelve una response
$response = $kernel->handle($request);

// Se envia la response al cliente
$response->send();