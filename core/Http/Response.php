<?php

namespace PurrPHP\Http;

class Response {

  public function __construct(
    private mixed $content,
    private int $status = 200,
    private array $headers = array()
  ) {}

  public function send() {
    http_response_code($this->status);
    foreach ($this->headers as $key => $value) {
      header($key . ': ' . $value);
    }
    echo $this->content;
  }
}