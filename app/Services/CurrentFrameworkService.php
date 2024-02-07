<?php

namespace PurrPHP\App\Services;

class CurrentFrameworkService {

  public function getName(): string {
    return "PurrPHP";
  }
  public function getVersion(): string {
    return "0.1.0";
  }
}