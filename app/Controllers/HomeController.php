<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\App\Services\CurrentFrameworkService;
use PurrPHP\Http\Response;

class HomeController {

  public function __construct(
    private readonly CurrentFrameworkService $framework
  ) {}

  public function index() {
    return new Response("Hello from {$this->framework->getName()} v.{$this->framework->getVersion()}");
  }
}