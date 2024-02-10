<?php

/* ------------------------------ Used services ----------------------------- */
use PurrPHP\Routing\RouterInterface;
use PurrPHP\Routing\Router;

use PurrPHP\Middleware\RequestHandlerInterface;
use PurrPHP\Middleware\RequestHandler;
use PurrPHP\Middleware\Handlers\RouterDispatch;

use PurrPHP\Http\Kernel;

use PurrPHP\Session\SessionInterface;
use PurrPHP\Session\Session;

use Twig\Environment;
use PurrPHP\Template\TwigFactory;

use PurrPHP\Controller\AbstractController;

use PurrPHP\Database\DatabaseFactory;
use Doctrine\DBAL\Connection;

use PurrPHP\Console\Kernel as ConsoleKernel;
use PurrPHP\Console\Application;
use PurrPHP\Console\Commands\DatabaseMigrateCommand;

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

// Init Middlewares
$container->add(RequestHandlerInterface::class, RequestHandler::class)
  ->addArgument($container);

$container->add(RouterDispatch::class)
  ->addArgument(RouterInterface::class)
  ->addArgument($container);

// Init Kernel
$container->add(Kernel::class)
  ->addArgument(RouterInterface::class)
  ->addArgument($container)
  ->addArgument(RequestHandlerInterface::class);

// Init sessions
$container->addShared(SessionInterface::class, Session::class);

// Init twig
$container->add('twig-factory', TwigFactory::class)
  ->addArgument(SessionInterface::class);

$container->addShared('twig', function() use ($container): Environment {
  return $container->get('twig-factory')->create();
});

// Init abstact controller
$container->inflector(AbstractController::class)
  ->invokeMethod('setContainer', array($container));

// Init database
$container->add(DatabaseFactory::class)
  ->addArgument(new ArrayArgument($databaseConfig));

$container->addShared(Connection::class, function() use ($container): Connection {
  return $container->get(DatabaseFactory::class)->create();
});

// Init console
$container->add(Application::class)
  ->addArgument($container);

$container->add(ConsoleKernel::class)
  ->addArgument($container)
  ->addArgument(Application::class);

// Init console commands
$container->add('db:migrate', DatabaseMigrateCommand::class)
  ->addArgument(Connection::class);

/* ---------------------------- Return container ---------------------------- */
return $container;