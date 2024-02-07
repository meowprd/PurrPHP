<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;
use PurrPHP\App\Services\CurrentFrameworkService;

class HomeController extends AbstractController {

  public function __construct(
    private readonly CurrentFrameworkService $framework
  ) {}

  public function index() {
    return $this->render('home.html.twig', array(
      'frameworkName' => $this->framework->getName(),
      'frameworkVersion' => $this->framework->getVersion(),
    ));
  }
}