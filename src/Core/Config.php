<?php
namespace TurgunboyevUz\SPDO\Core;

class Config{
    public static $config = [];

    public static function load($folder){
        $files = glob($folder."/*.php");

        foreach ($files as $filename) {
            $file = str_replace('.php', '', $filename);
            $ex = explode('/', $file);

            $config_name = end($ex);

            self::$config[$config_name] = require $filename;
        }
    }

    public static function set($key, $value){
        $key = explode('.', $key);

        self::$config[$key[0]][$key[1]] = $value;
    }

    public static function get($key, $default = null){
        $key = explode('.', $key);

        return self::$config[$key[0]][$key[1]] ?? $default;
    }
}
?>