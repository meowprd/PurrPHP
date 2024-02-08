<?php

use PurrPHP\Routing\Route;
use PurrPHP\Http\Response;

use PurrPHP\App\Controllers\HomeController;
use PurrPHP\App\Controllers\FormController;

return array(
  Route::get('/', array(HomeController::class, 'index')),
  Route::get('/form', array(FormController::class, 'index')),
  Route::post('/form', array(FormController::class, 'post')),
);