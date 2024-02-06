<?php

namespace PurrPHP\Http;

use PurrPHP\Http\Response;

use PurrPHP\Routing\RouterInterface;

class Kernel {

  public function __construct(
    private RouterInterface $router
  ) {}

  public function handle(Request $request): Response {
    try {
      [$handler, $vars] = $this->router->dispatch($request);
      return call_user_func_array($handler, $vars);
    } catch(\Throwable $e) {
      return new Response($e->getMessage(), 500);
    }
  }
}