<?php

namespace PurrPHP\Routing;

class Route {
  
  public static function get(string $uri, array|callable $handler): array {
    return array('GET', $uri, $handler);
  }

  public static function post(string $uri, array|callable $handler): array {
    return array('POST', $uri, $handler);
  }
}