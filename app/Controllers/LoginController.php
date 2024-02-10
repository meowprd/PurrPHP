<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;

class LoginController extends AbstractController {

  public function __construct() {}

  public function index() {
    return $this->render('login.html.twig');
  }

  public function post() {
    dd($this->request->input('name'));
  }
}