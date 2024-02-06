<?php

namespace PurrPHP\Http;

use PurrPHP\Http\Response;
use PurrPHP\Routing\RouterInterface;

use PurrPHP\Exceptions\RouteNotFoundException;
use PurrPHP\Exceptions\MethodNotAllowedException;

class Kernel {

  public function __construct(
    private RouterInterface $router
  ) {}

  public function handle(Request $request): Response {
    try {
      [$handler, $vars] = $this->router->dispatch($request);
      return call_user_func_array($handler, $vars);
    } catch(RouteNotFoundException $e) {
      return new Response($e->getMessage(), 404);
    } catch(MethodNotAllowedException $e) {
      return new Response($e->getMessage(), 405);
    } catch(\Throwable $e) {
      return new Response($e->getMessage(), 500);
    }
  }
}