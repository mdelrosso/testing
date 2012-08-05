<?php
error_reporting(E_ALL | E_STRICT);

/* RUTAS */
define('HOME', 'C:\wamp\www\dev\oop-uml-practices');
define('APP_NAME', 'practico8');
define('APP', HOME . DIRECTORY_SEPARATOR . APP_NAME );
define('LOG', APP . DIRECTORY_SEPARATOR . 'logs' );

/* 3 CAPAS */ 
define('PRE', APP . DIRECTORY_SEPARATOR . 'presentacion');
define('DOM', APP . DIRECTORY_SEPARATOR . 'dominio');
define('PER', APP . DIRECTORY_SEPARATOR . 'persistencia');

define('TOOLS', APP . DIRECTORY_SEPARATOR . 'tools');

/* TESTING */
define('DEBUG', false);
define('DEBUG_FILE_LOG', APP_NAME . '.log');
