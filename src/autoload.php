<?php

$prefix = 'TurgunboyevUz\\SPDO\\';

use TurgunboyevUz\SPDO\Database\Connection;
use TurgunboyevUz\SPDO\Core\Config;

spl_autoload_register(function ($class)  use ($prefix){
    $class = substr($class, strlen($prefix));
    $path = __DIR__.'/'.str_replace('\\', '/', $class).'.php';
    
    if(file_exists($path)){
        require $path;
    }
});

foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
    require $filename;
}

Config::load(__DIR__.'/Config');

Connection::connect([
    'host' => config('database.host'),
    'dbname' => config('database.database'),
    'charset' => config('database.charset'),
    'port' => config('database.port')

], config('database.driver'), config('database.username'), config('database.password'));