<?php

namespace PurrPHP\Http;

use PurrPHP\Http\Response;
use PurrPHP\Routing\RouterInterface;

use League\Container\Container;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

use PurrPHP\Middleware\RequestHandlerInterface;

use PurrPHP\Exceptions\RouteNotFoundException;
use PurrPHP\Exceptions\MethodNotAllowedException;

class Kernel {

  public function __construct(
    private RouterInterface $router,
    private Container $container,
    private RequestHandlerInterface $requestHandler
  ) { $this->registerWhoops(); }

  public function handle(Request $request): Response {
    try {
      return $this->requestHandler->handle($request);
    } catch(\Exception $e) {
      return $this->resolveException($e);
    }
  }

  public function terminate(Request $request, Response $response) {
    $request->session()?->removeFlash();
  }

  private function resolveException(\Exception $e): Response {
    if(DEBUG) { throw $e; }
    
    if($e instanceof RouteNotFoundException) {
      return new Response($e->getMessage(), 404);
    } elseif($e instanceof MethodNotAllowedException) {
      return new Response($e->getMessage(), 405);
    } else {
      return new Response($e->getMessage(), 500);
    }
  }

  private function registerWhoops() { 
    if(!DEBUG) { return; }
    $run = new Run(); // whoops run
    $handler = new PrettyPageHandler(); // whoops handler
    
    $handler->setPageTitle('PurrPHP - Exception!');
    $run->pushHandler($handler);
    $run->register();
  }
}