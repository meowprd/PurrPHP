<?php

namespace PurrPHP\Routing;

use PurrPHP\Http\Request;

interface RouterInterface {
  
  public function dispatch(Request $request): array;
}