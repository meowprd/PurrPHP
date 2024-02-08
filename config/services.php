<?php

/* ------------------------------ Used services ----------------------------- */
use PurrPHP\Routing\RouterInterface;
use PurrPHP\Routing\Router;
use PurrPHP\Http\Kernel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use PurrPHP\Controller\AbstractController;
use PurrPHP\Database\DatabaseFactory;
use Doctrine\DBAL\Connection;

/* ----------------------------- Init container ----------------------------- */
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
$container = new Container();
$container->delegate(new ReflectionContainer(true));

/* --------------------------- Get database config -------------------------- */
$databaseConfig = require(CONFIG_PATH . '/database.php');

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

$container->addShared('twig', Environment::class)
  ->addArgument('twig-loader');

// Init abstact controller
$container->inflector(AbstractController::class)
  ->invokeMethod('setContainer', array($container));

// Init database
$container->add(DatabaseFactory::class)
  ->addArgument(new ArrayArgument($databaseConfig));

$container->addShared(Connection::class, function() use ($container): Connection {
  return $container->get(DatabaseFactory::class)->create();
});
/* ---------------------------- Return container ---------------------------- */
return $container;