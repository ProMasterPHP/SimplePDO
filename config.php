<?php
require "src/Autoloader.php";

Autoloader::boot(Autoloader::find('Model'));

use TurgunboyevUz\SimplePDO\Database;

Database::connect('mysql', [
    'host' => 'localhost',
    'port'=>3306,
    'charset' => 'utf8mb4',
    'dbname' => 'codearch'
], 'root', 'OnlineWolf2003');
?>