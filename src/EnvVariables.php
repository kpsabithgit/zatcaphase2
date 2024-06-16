<?php
namespace Sabith\Zatcaphase2;

use Dotenv\Dotenv;

class EnvVariables
{
    public static function get($key)
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');

        $dotenv->load();
        return $_ENV[$key];

    }
}
