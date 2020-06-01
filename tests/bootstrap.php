<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    Dotenv\Dotenv::createImmutable(__DIR__.'/../')->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    exit('Missing .env file.'.PHP_EOL);
}
