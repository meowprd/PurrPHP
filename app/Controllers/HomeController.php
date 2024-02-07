<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\App\Services\CurrentFrameworkService;
use PurrPHP\Http\Response;
use Twig\Environment;

class HomeController {

  public function __construct(
    private readonly CurrentFrameworkService $framework,
    private readonly Environment $twig
  ) {}

  public function index() {
    return new Response("Hello from {$this->framework->getName()} v.{$this->framework->getVersion()}");
  }
}