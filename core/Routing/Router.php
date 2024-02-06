<?php

namespace PurrPHP\Routing;

use PurrPHP\Http\Request;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

use PurrPHP\Exceptions\MethodNotAllowedException;
use PurrPHP\Exceptions\RouteNotFoundException;

class Router implements RouterInterface {

  public function dispatch(Request $request): array {
    $dispatcher = $this->registerRoutes();
    $routeInfo = $dispatcher->dispatch($request->method(), $request->uri());
    
    switch($routeInfo[0]) {
      case Dispatcher::FOUND: 
        [$status, $handler, $vars] = $routeInfo;
        if(is_array($handler)) {
          [$controller, $method] = $handler;
          return array(array(new $controller(), $method), $vars);
        } else {
          return array($handler, $vars);
        }
      case Dispatcher::METHOD_NOT_ALLOWED: throw new MethodNotAllowedException("{$request->method()} method not allowed");
      default: throw new RouteNotFoundException("Route {$request->method()} {$request->uri()} not found");
    }
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