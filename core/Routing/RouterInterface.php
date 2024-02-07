<?php

namespace PurrPHP\Routing;

use PurrPHP\Http\Request;

interface RouterInterface {
  
  public function dispatch(Request $request): array;
  public function setRoutesPath(string $path): void;
}