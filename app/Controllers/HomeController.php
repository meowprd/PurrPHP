<?php

namespace PurrPHP\App\Controllers;

use Doctrine\DBAL\Connection;
use PurrPHP\App\Services\UserService;
use PurrPHP\Controller\AbstractController;
use PurrPHP\App\Services\CurrentFrameworkService;

class HomeController extends AbstractController {

  public function __construct(
    private readonly CurrentFrameworkService $framework,
    private readonly UserService $userService
  ) {}

  public function index() {
    return $this->render('home.html.twig', array(
      'frameworkName' => $this->framework->getName(),
      'frameworkVersion' => $this->framework->getVersion(),
    ));
  }

  public function usersList() {
    return $this->render('usersList.html.twig', array(
      'users' => $this->userService->getAll()
    ));
  }
}