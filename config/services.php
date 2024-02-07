<?php

/* ------------------------------ Used services ----------------------------- */
use PurrPHP\Routing\RouterInterface;
use PurrPHP\Routing\Router;
use PurrPHP\Http\Kernel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/* ----------------------------- Init container ----------------------------- */
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
$container = new Container();
$container->delegate(new ReflectionContainer(true));

/* ------------------------------ Init services ----------------------------- */
// Init Router
$container->add(RouterInterface::class, Router::class);
$container->extend(RouterInterface::class)
  ->addMethodCall('setRoutesPath', array(new StringArgument(ROUTES_PATH)));

// Init Kernel
$container->add(Kernel::class)
  ->addArgument(RouterInterface::class)
  ->addArgument($container);

// Init twig
$container->addShared('twig-loader', FilesystemLoader::class)
  ->addArgument(new StringArgument(VIEWS_PATH));

$container->addShared(Environment::class)
  ->addArgument('twig-loader');

/* ---------------------------- Return container ---------------------------- */
return $container;