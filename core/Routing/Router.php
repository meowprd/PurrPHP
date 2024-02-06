<?php

namespace PurrPHP\Routing;

use PurrPHP\Http\Request;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface {

  public function dispatch(Request $request): array {
    $dispatcher = $this->registerRoutes();
    [$status, [$controller, $method], $vars] = $dispatcher->dispatch($request->method(), $request->uri());
    return array(
      array(new $controller(), $method),
      $vars
    );
  }

  private function registerRoutes(): Dispatcher {
    return simpleDispatcher(function(RouteCollector $collector) {
      $routes = require(APP_PATH . '/config/routes.php');
      foreach($routes as $route) {
        $collector->addRoute(...$route);
      }
    });
  }
}