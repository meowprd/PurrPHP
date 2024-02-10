<?php

namespace PurrPHP\Middleware;

use League\Container\Container;
use PurrPHP\Http\Request;
use PurrPHP\Http\Response;

use PurrPHP\Middleware\Handlers\RouterDispatch;

class RequestHandler implements RequestHandlerInterface {

  private array $middleware = array(
    RouterDispatch::class
  );

  public function __construct(
    private Container $container
  ) {}

  public function handle(Request $request): Response {
    if(empty($this->middleware)) { return new Response('Server error', 500); }

    $middlewareClass = array_shift($this->middleware);
    $middleware = $this->container->get($middlewareClass);
    $response = $middleware->process($request, $this);
    return $response;
  }
}