<?php

use PurrPHP\Routing\Route;
use PurrPHP\Http\Response;

use PurrPHP\App\Controllers\HomeController;
use PurrPHP\App\Controllers\RegisterController;
use PurrPHP\App\Controllers\LoginController;

use PurrPHP\App\Middlewares\TestMiddleware;

return array(
  Route::get('/', array(HomeController::class, 'index'), array(TestMiddleware::class)),
  
  Route::get('/register', array(RegisterController::class, 'index')),
  Route::post('/register', array(RegisterController::class, 'post')),

  Route::get('/login', array(LoginController::class, 'index')),
  Route::post('/login', array(LoginController::class, 'post')),

  Route::get('/users/list', array(HomeController::class, 'usersList')),
  Route::get('/test', function() { return new Response("test"); })
);