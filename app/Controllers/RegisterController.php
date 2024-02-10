<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;

class RegisterController extends AbstractController {

  public function __construct() {}

  public function index() {
    return $this->render('register.html.twig');
  }

  public function post() {
    dd($this->request->input('name'));
  }
}