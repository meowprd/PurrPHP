<?php

namespace PurrPHP\Controller;

use League\Container\Container;
use PurrPHP\Http\Request;
use PurrPHP\Http\Response;

abstract class AbstractController {

  protected ?Container $container = null;
  protected Request $request;

  public function setContainer(Container $container): void {
    $this->container = $container;
  }

  public function render(string $view, array $data = array(), Response $response = null): Response {
    $response ??= new Response();
    return $response->setContent($this->container->get('twig')->render($view, $data));
  }

  public function setRequest($request): self {
    $this->request = $request;
    return $this;
  }
}