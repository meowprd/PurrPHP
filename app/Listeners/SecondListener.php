<?php

namespace PurrPHP\App\Listeners;

use PurrPHP\Event\ResponseEvent;

class SecondListener {
  
  public function __invoke(ResponseEvent $event) {
    dump("SecondListener call");
  }
}