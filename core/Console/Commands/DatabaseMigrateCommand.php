<?php

namespace PurrPHP\Console\Commands;
use PurrPHP\Console\CommandInterface;
use PurrPHP\Console\ConsoleColors;

class DatabaseMigrateCommand implements CommandInterface {

  private string $command = 'db:migrate';

  public function execute(array $params = array()): int {
    echo(ConsoleColors::LIGHT_CYAN . 'Running ' . $this->command . PHP_EOL);
    dd($params);
    return 0;
  }

}