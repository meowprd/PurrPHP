<?php

namespace PurrPHP\Controller;

use League\Container\Container;
use Twig\Environment;
use PurrPHP\Http\Response;

abstract class AbstractController {

  protected ?Container $container = null;

  public function setContainer(Container $container): void {
    $this->container = $container;
  }

  public function render(string $view, array $data = array(), Response $response = null): Response {
    $response ??= new Response();
    return $response->setContent($this->container->get('twig')->render($view, $data));
  }
}