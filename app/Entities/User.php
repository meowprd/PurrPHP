<?php

namespace PurrPHP\App\Entities;

class User {

  public function __construct(
    private ?int $id,
    private string $name,
    private \DateTimeImmutable|null $createdAt
  ) {}

  public static function create(string $name, ?int $id = null, \DateTimeImmutable|null $createdAt = null): static
  {
    return new static($id, $name, $createdAt);
  }
}