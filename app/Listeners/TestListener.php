<?php

namespace PurrPHP\App\Listeners;

use PurrPHP\Event\ResponseEvent;

class TestListener {
  
  public function __invoke(ResponseEvent $event) {
    dump("TestListener call");
  }
}