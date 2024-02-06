<?php

use PurrPHP\Routing\Route;

return array(
  Route::get('/', array(HomeController::class, 'index'))
);