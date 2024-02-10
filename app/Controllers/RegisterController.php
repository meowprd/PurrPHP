<?php

namespace PurrPHP\App\Controllers;
use PurrPHP\Controller\AbstractController;

use PurrPHP\App\Entities\User;
use PurrPHP\App\Services\UserService;

class RegisterController extends AbstractController {

  public function __construct(
    private UserService $service
  ) {}

  public function index() {
    return $this->render('register.html.twig');
  }

  public function post() {
    $user = User::create($this->request->input('name'));
    dd($this->service->save($user));
  }
}