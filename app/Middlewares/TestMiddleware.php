<?php

namespace PurrPHP\App\Middlewares;

use PurrPHP\Middleware\MiddlewareInterface;
use PurrPHP\Http\Request;
use PurrPHP\Middleware\RequestHandlerInterface;
use PurrPHP\Http\Response;
use PurrPHP\Http\RedirectResponse;

class TestMiddleware implements MiddlewareInterface {
  
  private static $auth = true;

  public function process(Request $request, RequestHandlerInterface $handler): Response {
    if(self::$auth) { return $handler->handle($request); }
    return new Response('auth failed', 401);
  }
}