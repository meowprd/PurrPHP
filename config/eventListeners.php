<?php

use PurrPHP\Event\ResponseEvent;
use PurrPHP\App\Listeners\TestListener;
use PurrPHP\App\Listeners\SecondListener;

use PurrPHP\Event\ServiceEvent;
use PurrPHP\App\Listeners\ServicesListener;

return array(
  ResponseEvent::class => array(
    TestListener::class,
    SecondListener::class
  ),
  
  ServiceEvent::class => array(
    ServicesListener::class
  )
);