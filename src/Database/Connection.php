<?php
namespace TurgunboyevUz\SPDO\Database;

use PDO;
class Connection{
    
    public static PDO $connection;

    public static function connect($dsn, $driver, $user, $password){
        $dsn = $driver.':'.http_build_query($dsn, '', ';');

        self::$connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}