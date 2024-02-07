<?php

namespace PurrPHP\Controller;

use League\Container\Container;

abstract class AbstractController {

  protected ?Container $container = null;

  public function setContainer(Container $container): void {
    $this->container = $container;
  }
}