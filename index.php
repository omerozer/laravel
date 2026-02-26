<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Hostinger shared hosting - anadizine deploy için src/ yolu
$laravelRoot = __DIR__.'/src';

// Maintenance mode kontrolü
if (file_exists($maintenance = $laravelRoot.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require $laravelRoot.'/vendor/autoload.php';

// Laravel bootstrap
/** @var Application $app */
$app = require_once $laravelRoot.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
