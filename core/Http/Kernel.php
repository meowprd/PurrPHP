<?php

namespace PurrPHP\Http;

use PurrPHP\Http\Response;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

class Kernel {

  public function handle(Request $request): Response {
    $dispatcher = $this->registerRoutes();
    [$status, [$controller, $method], $vars] = $dispatcher->dispatch($request->method(), $request->uri());
    return call_user_func_array([$controller, $method], $vars);
  }

  public function registerRoutes(): Dispatcher {
    return simpleDispatcher(function(RouteCollector $collector) {
      $routes = require(APP_PATH . '/config/routes.php');
      foreach($routes as $route) {
        $collector->addRoute(...$route);
      }
    });
  }
}