<?php
namespace TurgunboyevUz\SPDO\Core;

class Config {
    private static $config = [];

    public static function load($dir) {
        $files = glob("$dir/*.php");

        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            self::$config[$name] = require $file;
        }
    }

    public static function get($key, $default = null) {
        $keys = explode('.', $key);
        $config = self::$config;

        foreach ($keys as $segment) {
            if (!is_array($config) || !array_key_exists($segment, $config)) {
                return $default;
            }

            $config = $config[$segment];
        }

        return $config;
    }
}
