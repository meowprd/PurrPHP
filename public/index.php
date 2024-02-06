<?php
define("APP_PATH", dirname(__DIR__));
require_once(APP_PATH . '/vendor/autoload.php');

use PurrPHP\Http\Kernel;
use PurrPHP\Http\Request;
use PurrPHP\Routing\Router;

$router = new Router();
(new Kernel($router))->handle(Request::createFromGlobals())->send();