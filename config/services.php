<?php

/* ------------------------------ Used services ----------------------------- */
use PurrPHP\Routing\RouterInterface;
use PurrPHP\Routing\Router;
use PurrPHP\Http\Kernel;

/* ----------------------------- Init container ----------------------------- */
use League\Container\Container;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
$container = new Container();

/* ------------------------------ Init services ----------------------------- */
// Init Router
$container->add(RouterInterface::class, Router::class);
$container->extend(RouterInterface::class)
  ->addMethodCall('setRoutesPath', array(new StringArgument(ROUTES_PATH)));

// Init Kernel
$container->add(Kernel::class)
  ->addArgument(RouterInterface::class);

/* ---------------------------- Return container ---------------------------- */
return $container;