<?php

use PurrPHP\Routing\Route;
use PurrPHP\Http\Response;

use PurrPHP\App\Controllers\HomeController;

return array(
  Route::get('/', array(HomeController::class, 'index')),
  Route::get('/test', function() {
    return new Response('Test route');
  })
);