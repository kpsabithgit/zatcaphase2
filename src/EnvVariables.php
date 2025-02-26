<?php

namespace Sabith\Zatcaphase2;

use Dotenv\Dotenv;

class EnvVariables
{
    public static function get($key)
    {
        //$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../../');

        $dotenv->load();
        if ($_ENV['STACKCUE_API_CONFIG_METHOD'] == 'env') {
            return $_ENV[$key];
        } else if ($_ENV['STACKCUE_API_CONFIG_METHOD'] == 'configfile') {

            $configFile = __DIR__ . '/../../../../' . $_ENV['STACKCUE_API_CONFIG_FILE_LOCATION'];

            // Validate the file path
            if (file_exists($configFile) && is_file($configFile)) {
                $config = require $configFile;
            } else {
                throw new \Exception("Configuration file not found or invalid: $configFile");
            }
            return $config[$key];
        }
    }
}
