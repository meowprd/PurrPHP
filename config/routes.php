<?php

use PurrPHP\Routing\Route;

use PurrPHP\App\Controllers\HomeController;

return array(
  Route::get('/', array(HomeController::class, 'index'))
);