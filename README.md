# PurrPHP - Lightweight PHP framework

[![wakatime](https://wakatime.com/badge/github/meowprd/PurrPHP.svg)](https://wakatime.com/badge/github/meowprd/PurrPHP)


# Project structure

```
. 									            # root directory
├── app/							          # application directory
│   ├── Controllers		          # application controllers
│   ├── Entities			          # application entities
│   ├── Listeners			          # application event listeners	
│   ├── Middlewares		          # application middlewares
│   ├── Services			          # application services
│   └── Views					          # application views
├── config/						          # application config directory
│   ├── app.php						      # base application config			
│   ├── database.php				    # application database config
│   ├── eventListeners.php			# application listeners list for event
│   ├── routes.php					    # application allowed routes
│   └── services.php				    # application container
├── core/							          # framework directory
│   ├── Console/					      # CLI
│   │   ├── Application.php			# launch CLI command
│   │   ├── CommandInterface.php	# command interface for custom commands
│   │   ├── ConsoleColors.php		# const vars for colored output
│   │   ├── ConsoleException.php	# CLI exception handler
│   │   ├── Kernel.php				  # CLI Kernel (main handler)
│   │   └── Commands/				    # system CLI commands
│   │       └── DatabaseMigrateCommand.php 
│   ├── Controller/					    # main classes for app controllers
│   │   └── AbstractController.php	
│   ├── Database/					      # database connection providers
│   │   └── DatabaseFactory.php
│   ├── Entity/						      # main classes for app entities
│   │   ├── AbstractEntity.php
│   │   └── EntityService.php		# main entity service (call eventDispatcher)
│   ├── Event/						      # event manager classes
│   │   ├── Event.php				    # abstract event
│   │   ├── EventDispatcher.php	# used for register listeners and dispatch events
│   │   ├── ResponseEvent.php		# base response event
│   │   └── ServiceEvent.php		# base service event
│   ├── Exceptions/					    # application exceptions
│   │   ├── HttpException.php
│   │   ├── MethodNotAllowedException.php
│   │   └── RouteNotFoundException.php
│   ├── Http/						        # base work with http requests
│   │   ├── Kernel.php				  # http kernel (main handler)
│   │   ├── RedirectResponse.php	# response with redirect header
│   │   ├── Request.php				  # info about current request
│   │   └── Response.php			  # returns answer for request
│   ├── Middleware/					    # base work with middleware
│   │   ├── MiddlewareInterface.php # middleware interface for custom middlewares
│   │   ├── RequestHandler.php	# request handler with middleware
│   │   ├── RequestHandlerInterface.php
│   │   ├── RouteMiddleware.php	# dispatch current route and start middleware handlers
│   │   └── Handlers/				    # base middlewares handlers
│   │       ├── RouterDispatch.php
│   │       └── StartSession.php
│   ├── Routing/					      # base routing
│   │   ├── Route.php				    # registration routes objects
│   │   ├── Router.php				  # route dispatcher
│   │   └── RouterInterface.php
│   ├── Session/					      # base work with sessions
│   │   ├── Session.php				
│   │   └── SessionInterface.php
│   └── Template/					      # base work with html template manager
│       └── TwigFactory.php
├── database/						        # database dumps and migrations for CLI
│   └── migrations/			
├── public/							        # public folder
│   ├── assets						      # some assets
│   ├── .htaccess		
│   └── index.php					      # application entry point
├── vendor							
├── .htaccess		
├── composer.json
└── purr							          # CLI entry point
```

# Simple usage guide

## Routing

Framework routing provides by `nikic/fast-route` package. 

Into file `./config/routes.php` add new Route object

### Route class functions

```php
static function get(string $uri, array|callable $handler, array $middleware = array()): array; // Add new get route
static function post(string $uri, array|callable $handler, array $middleware = array()): array; // Add new post route
static function put(string $uri, array|callable $handler, array $middleware = array()): array; // Add new put route
static function delete(string $uri, array|callable $handler, array $middleware = array()): array; // Add new delete route
```

### Example

```php
<?php

use PurrPHP\Routing\Route;
use PurrPHP\Http\Response;

use PurrPHP\App\Controllers\HomeController;
use PurrPHP\App\Middlewares\HomeMiddleware;

return array(
    // with class usage
	Route::get('/', array(HomeController::class, 'index'), array(HomeMiddleware::class)),
    Route::get('/user/{name}', array(HomeController::class, 'showUser')),
    
    // with anonymous func
    Route::get('/', function() { return new Response('Home index'); }, array(HomeMiddleware::class)),
    Route::get('/user/{name}', function($user) { return new Response("Show user: $user"); })
);
```

## Controllers

All application controllers are stored in `./app/Controllers/`

Automatic injection is supported

### Example

```php
<?php
    
namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;
use PurrPHP\Http\Response;
use PurrPHP\App\Services\SomeService;

class HomeController extends AbstractController {
    
    public function __construct(
    	private readonly SomeService $service
    ) {}
    
    // Simple render
    public function index() {
        return $this->render('someTemplate.html.twig', array(
        	'someVar' => $this->service->someFunc()
        ));
    }
    
    // Validation form
    public function post() {
        $validation = $this->validation->make(array(
        	'foo' => $this->request->input('foo')
        ), array(
        	'foo' => 'required|min:5|max:20'
        ));
        $validation->validate();
        if($validation->fails()) {
            // $validation->errors()->all() [Get all errors]
            // $validation->errors()->toArray() [Get all errors in array with keys as input fields]
            return new Response('Validation failed!');
        }
        return new Response('Validation succ');
    }
}
```

## Services

Wrapper for working with entities

All application services are stored in `./app/Services/`

All application entities are stored in `./app/Entities/`

### Example entity

```php
<?php

namespace PurrPHP\App\Entities;

use PurrPHP\Entity\AbstractEntity;

class User extends AbstractEntity {
    
    public function __construct(
    	private ?int $id,
        private string $name,
        private \DateTimeImmutable|null $createdAt
    ) {}
    
    public static function create(string $name, ?int $id = null, \DateTimeImmutable|null $createdAt = null): static {
        return new static($id, $name, $createdAt ?? new \DateTimeImmutable);
    }
    
    public function id() { return $this->id; }
    public function setId(int $id) { $this->id = $id; return $this; }
    public function name() { return $this->name; }
    public function createdAt() { return $this->createdAt; }
}
```

### Example entity service

```php
<?php

namespace PurrPHP\App\Services;

use PurrPHP\App\Entities\User;
use PurrPHP\Entity\EntityService;

class UserService {
    
    public function __construct(
    	private EntityService $service
    ) {}
    
    // saving User entity to database
    public function save(User $user): User {
        $queryBuilder = $this->service->connection()->createQueryBuilder();
        $queryBuilder
        	->insert('users')
            ->values(array('name' => ':name', 'created_at' => ':created_at'))
            ->setParameter('name', $user->name)
            ->setParameter('created_at', $user->createdAt()->format('Y-m-d H:i:s'))
            ->execureQuery();
        $user->setId($this->service->save($user));
        return $user;
    }
    
    // get User entity from database by ID field
    public function getById(int $id): ?User {
        $user = $this->service->connection()->createQueryBuilder()
          ->select('*')
          ->from('users')
          ->where('id = :id')
          ->setParameter('id', $id)
          ->executeQuery()
          ->fetchAssociative();

        if(!$user) { return null; }
        return User::create($user['name'], $user['id'], new \DateTimeImmutable($user['created_at']));
    }
}

```

### Example independent service

```php
<?php
    
namespace PurrPHP\App\Services;

class SomeService {
    
    public function getString(): string { return "foo"; }
}
```

## Middleware

All application middleware are stored in `./app/Middlewares/`

### Example

```php
<?php
    
namespace PurrPHP\App\Middlewares;

use PurrPHP\Middleware\MiddlewareInterface;
use PurrPHP\Middleware\RequestHandlerInterface;
use PurrPHP\Http\Request;
use PurrPHP\Http\Response;
use PurrPHP\Http\RedirectResponse;

class SomeMiddleware implements MiddlewareInterface {
    
    private $auth = false;
    
    public function process(Request $request, RequestHandlerInterface $handler): Response {
        if($this->auth) { return $handler->handle($request); }
        return new Response('auth failed', 403); // without redirect
        // @
        return new RedirectResponse('/login'); // with redirect
    }
}

```

## Event listeners

All application listeners are stored in `./app/Listeners/`

### Example response event

```php
<?php
    
namespace PurrPHP\App\Listeners;

use PurrPHP\Event\ResponseEvent;

class SomeResponseEventListener {
    
    public function __invoke(ResponseEvent $event) {
        exit('SomeResponseEventListener called');
    }
}
```

### Example service save event

```php
<?php
    
namespace PurrPHP\App\Listeners;

use PurrPHP\Event\ServiceEvent;

class SomeServiceEventListener {
    
    public function __invoke(ServiceEvent $event) {
        var_dump($event->service()); // or dd($event->service())
        exit('SomeServiceEventListener called'); 
    }
}
```

## Template views

Template views powered by Twig

All application views are stored in `./app/Views/`

Available variables inside templates by default:

```php
function dump(...) // if DEBUG=true in app.php config
const APP_NAME // from app.php config
function session() // current session
```

