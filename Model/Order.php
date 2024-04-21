<?php

use TurgunboyevUz\SimplePDO\Model;

class Order extends Model{
    protected static $table = 'orders';
    
    public static function up(){
        return self::query("CREATE TABLE `orders` (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id BIGINT NOT NULL,
            product_id INT(11) NOT NULL,
            status VARCHAR(255) NOT NULL,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public static function down(){
        return self::dropIfExists();
    }

    public static function seed(){
        for($i = 0; $i < 10; $i++){
            self::insert([
                'user_id' => rand(10000, 99999),
                'product_id' => rand(10, 100),
                'status' => 'Processing'
            ]);
        }
    }
}
?>