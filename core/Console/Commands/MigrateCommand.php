<?php

namespace PurrPHP\Console\Commands;
use PurrPHP\Console\CommandInterface;

class MigrateCommand implements CommandInterface {

  private string $command = 'migrate';

  public function execute(array $params = array()): int {
    
    return 0;
  }

}