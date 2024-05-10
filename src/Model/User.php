<?php
namespace TurgunboyevUz\SPDO\Model;

use TurgunboyevUz\SPDO\Core\Model;

class User extends Model{
    protected static $table = 'users';

    public static function up(){
        return self::query("CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(255) NOT NULL,

            PRIMARY KEY (`id`)
        )");
    }

    public static function down(){
        return self::dropIfExists();
    }
}
?>