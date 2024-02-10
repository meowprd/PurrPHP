<?php

namespace PurrPHP\App\Services;

use PurrPHP\App\Entities\User;
use PurrPHP\Entity\EntityService;

class UserService {

  public function __construct(
    private EntityService $service
  ) {}

  public function save(User $user): User {
    $queryBuilder = $this->service->connection()->createQueryBuilder();
    $queryBuilder
      ->insert('users')
      ->values(array('name' => ':name', 'created_at' => ':created_at'))
      ->setParameter('name', $user->name())
      ->setParameter('created_at', $user->createdAt()->format('Y-m-d H:i:s'))
      ->executeQuery();
    $user->setId($this->service->save($user));
    return $user;
  }

  public function getById(int $id): ?User {
    $user = $this->service->connection()->createQueryBuilder()
      ->select('*')
      ->from('users')
      ->where('id = :id')
      ->setParameter('id', $id)
      ->executeQuery()
      ->fetchAssociative();
    
    if(!$user) { return null; }
    return User::create($user['name'], $user['id'], new \DateTimeImmutable($user['created_at']));
  }

  public function getAll(): array {
    $users = $this->service->connection()->createQueryBuilder()
      ->select('*')
      ->from('users')
      ->executeQuery()
      ->fetchAllAssociative();
    return array_map(fn($user) => User::create($user['name'], $user['id'], new \DateTimeImmutable($user['created_at'])), $users);
  }
}