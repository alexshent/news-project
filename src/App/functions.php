<?php

declare(strict_types=1);

use Framework\Http;

function dd(mixed $value): void
{
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die();
}

function e(mixed $value): string
{
  return htmlspecialchars((string) $value);
}

function redirectTo(string $path): void
{
  header("Location: {$path}");
  http_response_code(Http::REDIRECT_STATUS_CODE);
  exit;
}
