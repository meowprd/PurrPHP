<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Http\Response;

class HomeController {

  public function index() {
    return new Response('Hello World from HomeController!');
  }
}