<?php

namespace PurrPHP\App\Entities;

use PurrPHP\Entity\AbstractEntity;

class User extends AbstractEntity {

  public function __construct(
    private ?int $id,
    private string $name,
    private \DateTimeImmutable|null $createdAt
  ) {}

  public static function create(string $name, ?int $id = null, \DateTimeImmutable|null $createdAt = null): static {
    return new static($id, $name, $createdAt ?? new \DateTimeImmutable);
  }

  public function id() { return $this->id; }
  public function setId(int $id) { $this->id = $id; return $this; }
  public function name() { return $this->name; }
  public function createdAt() { return $this->createdAt; }
}