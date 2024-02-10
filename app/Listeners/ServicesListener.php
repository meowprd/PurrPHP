<?php

namespace PurrPHP\App\Listeners;

use PurrPHP\Event\ServiceEvent;

class ServicesListener {
  
  public function __invoke(ServiceEvent $event) {
    dump("ServicesListener call", $event->service());
  }
}