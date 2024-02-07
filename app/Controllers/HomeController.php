<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;
use PurrPHP\App\Services\CurrentFrameworkService;
use PurrPHP\Http\Response;

class HomeController extends AbstractController {

  public function __construct(
    private readonly CurrentFrameworkService $framework
  ) {}

  public function index() {
    dd($this->container->get('twig'));
    return new Response("Hello from {$this->framework->getName()} v.{$this->framework->getVersion()}");
  }
}