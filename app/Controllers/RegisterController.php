<?php

namespace PurrPHP\App\Controllers;
use PurrPHP\Controller\AbstractController;

use PurrPHP\App\Entities\User;
use PurrPHP\App\Services\UserService;
use PurrPHP\Http\RedirectResponse;

class RegisterController extends AbstractController {

  public function __construct(
    private UserService $service
  ) {}

  public function index() {
    return $this->render('register.html.twig');
  }

  public function post() {
    return new RedirectResponse('/login');
    $user = User::create($this->request->input('name'));
  }
}