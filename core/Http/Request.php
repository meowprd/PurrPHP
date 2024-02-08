<?php

namespace PurrPHP\Http;

class Request {

  public function __construct(
    private readonly array $get,
    private readonly array $post,
    private readonly array $cookie,
    private readonly array $files,
    private readonly array $server
  ) {}

  public static function createFromGlobals(): static {
    return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
  }

  public function method(): string {
    return $this->server['REQUEST_METHOD'];
  }

  public function uri(): string {
    return strtok($this->server['REQUEST_URI'], '?');
  }

  public function input(string $key, $default = null): mixed {
    return $this->get[$key] ?? $this->post[$key] ?? $default;
  }

}