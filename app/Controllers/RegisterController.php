<?php

namespace PurrPHP\App\Controllers;
use PurrPHP\Controller\AbstractController;

use PurrPHP\App\Entities\User;
use PurrPHP\App\Services\UserService;
use PurrPHP\Http\Response;
use PurrPHP\Http\RedirectResponse;
use Rakit\Validation\Validator;

class RegisterController extends AbstractController {

  public function __construct(
    private UserService $service,
  ) {}

  public function index() {
    return $this->render('register.html.twig');
  }

  public function post() {
    $validation = $this->validator->make(array(
      'name' => $this->request->input('name'),
    ), array(
      'name' => 'required|min:5',
    ));
    
    /* $validation->validate();
    //if($validation->fails()) {
      // dd($validation->errors()->all());
      dd($validation->errors()->toArray());
    } else {
      dd("Validation succ!");
    }
    exit(); */
    //return new RedirectResponse('/login');
    $user = User::create($this->request->input('name'));
    $this->service->save($user);
    return new Response('succ');
  }
}