<?php

namespace PurrPHP\Database;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DatabaseFactory {

  public function __construct(
    private readonly array $databaseConfig
  ) {}

  public function create(): Connection {
    $connection = DriverManager::getConnection($this->databaseConfig);
    $connection->setAutoCommit(false);
    return $connection;
  }
}