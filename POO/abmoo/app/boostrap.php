<?php
// Boostrap file

// Configuration
require_once __DIR__.'/config.php';

// Basic files
require_once __DIR__.'/../vendor/Abmoo/Kernel/WebRequest.php';
require_once __DIR__.'/../vendor/Abmoo/Kernel/WebResponse.php';
require_once __DIR__.'/../vendor/Abmoo/Kernel/Kernel.php';

// Dependency Injection container (DIC)
require_once __DIR__.'/../vendor/Abmoo/DependencyInjection/DependencyInjectionContainer.php';
require_once __DIR__.'/../vendor/Abmoo/DependencyInjection/TestService.php';
require_once __DIR__.'/../vendor/Abmoo/DependencyInjection/TestDependence.php';

// Event dispatcher (ED)
require_once __DIR__.'/../vendor/Abmoo/EventDispatcher/EventDispatcher.php';
require_once __DIR__.'/../vendor/Abmoo/EventDispatcher/TestListener.php';

// Utilidades varias
require_once __DIR__.'/../vendor/Abmoo/Utils/Utils.php';


