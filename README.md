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

