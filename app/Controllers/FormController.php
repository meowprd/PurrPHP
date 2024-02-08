<?php

namespace PurrPHP\App\Controllers;

use PurrPHP\Controller\AbstractController;
use PurrPHP\Http\Request;

class FormController extends AbstractController {

  public function __construct() {}

  public function index() {
    return $this->render('form.html.twig');
  }

  public function post() {
    dd($_POST);
  }
}