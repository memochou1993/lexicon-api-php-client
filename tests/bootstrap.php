<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    Dotenv\Dotenv::createImmutable(__DIR__.'/../')->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    die($e->getMessage().PHP_EOL);
}
