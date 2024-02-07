<?php

// Used services
use PurrPHP\Routing\RouterInterface;
use PurrPHP\Routing\Router;
use PurrPHP\Http\Kernel;

// Init container
use League\Container\Container;
$container = new Container();

// Init services
$container->add(RouterInterface::class, Router::class);

$container->add(Kernel::class)
  ->addArgument(RouterInterface::class);

// Return container
return $container;