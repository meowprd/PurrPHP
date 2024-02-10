<?php

namespace PurrPHP\App\Services;

use Doctrine\DBAL\Connection;
use PurrPHP\App\Entities\User;

class UserService {

  public function __construct(
    private Connection $connection
  ) {}

  public function save(User $user): User {
    $queryBuilder = $this->connection->createQueryBuilder();
    $queryBuilder
      ->insert('users')
      ->values(array('name' => ':name', 'created_at' => ':created_at'))
      ->setParameter('name', $user->name())
      ->setParameter('created_at', $user->createdAt()->format('Y-m-d H:i:s'))
      ->executeQuery();
    $user->setId($this->connection->lastInsertId());
    return $user;
  }

  public function getById(int $id): ?User {
    $user = $this->connection->createQueryBuilder()
      ->select('*')
      ->from('users')
      ->where('id = :id')
      ->setParameter('id', $id)
      ->executeQuery()
      ->fetchAssociative();
    
    if(!$user) { return null; }
    return User::create($user['name'], $user['id'], new \DateTimeImmutable($user['created_at']));
  }
}