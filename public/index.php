<?php
require_once(dirname(__DIR__) . '/config/app.php');
require_once(APP_PATH . '/vendor/autoload.php');

use PurrPHP\Http\Kernel;
use PurrPHP\Http\Request;

/** @var \League\Container\Container $container */
$container = require(CONFIG_PATH . '/services.php');

$kernel = $container->get(Kernel::class);
$kernel->handle(Request::createFromGlobals())->send();