<?php

namespace PurrPHP\Routing;

use League\Container\Container;
use PurrPHP\Http\Request;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

use PurrPHP\Exceptions\MethodNotAllowedException;
use PurrPHP\Exceptions\RouteNotFoundException;

class Router implements RouterInterface {

  private array $routes = array();

  public function dispatch(Request $request, Container $container): array {
    $dispatcher = $this->registerRoutes();
    $routeInfo = $dispatcher->dispatch($request->method(), $request->uri());
    
    switch($routeInfo[0]) {
      case Dispatcher::FOUND: 
        [$status, $handler, $vars] = $routeInfo;
        if(is_array($handler)) {
          [$controller, $method] = $handler;
          $controller = $container->get($controller);
          return array(array($controller, $method), $vars);
        } else {
          return array($handler, $vars);
        }
      case Dispatcher::METHOD_NOT_ALLOWED: throw new MethodNotAllowedException("{$request->method()} method not allowed");
      default: throw new RouteNotFoundException("Route {$request->method()} {$request->uri()} not found");
    }
  }

  public function setRoutesPath(string $path): void {
    $this->routes = include($path);
  }

  private function registerRoutes(): Dispatcher {
    return simpleDispatcher(function(RouteCollector $collector) {
      foreach($this->routes as $route) {
        $collector->addRoute(...$route);
      }
    });
  }
}