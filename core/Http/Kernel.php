<?php

namespace PurrPHP\Http;

use PurrPHP\Http\Response;

class Kernel {

  public function handle(Request $request): Response {
    return new Response('Hello World!');
  }
}