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
}