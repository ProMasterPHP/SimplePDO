<?php

use TurgunboyevUz\SPDO\Core\Config;
use TurgunboyevUz\SPDO\Core\Validator;

function dd(...$args): void
{
    echo "<pre>";
    var_dump(...$args);
    echo "</pre>";

    die();
}

function pd(...$args): void
{
    echo "<pre>";
    print_r(...$args);
    echo "</pre>";
    die();
}

function config($key, $default = null){
    return Config::get($key, $default);
}

function validate($data){
    return new Validator($data);
}