<?php
require "src/Autoloader.php";

Autoloader::boot(Autoloader::find('Model'));

use TurgunboyevUz\SimplePDO\Database;

$sql = [
    'dbuser'=>'', // your database username
    'dbpass'=>'', // your database password
    'dbname'=>'' // your database name
];

Database::connect('mysql', [
    'host' => 'localhost',
    'port'=>3306,
    'charset' => 'utf8mb4',
    'dbname' => $sql['dbname'],
], $sql['dbuser'], $sql['dbpass']);
?>