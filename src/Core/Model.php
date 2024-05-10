<?php

namespace TurgunboyevUz\SPDO\Core;

use TurgunboyevUz\SPDO\Database\Connection;
use TurgunboyevUz\SPDO\Database\Database;

class Model{
    protected static $table;
    
    public static function db(){
        return new Database(Connection::$connection, static::$table);
    }

    public static function query($query, $params = []){
        return self::db()->query($query, $params);
    }

    public static function create(array $values){
        return self::db()->insert($values);
    }

    public static function where($columns, $value){
        return self::db()->where($columns, $value);
    }

    public static function orderByAsc($column){
        return self::db()->orderByAsc($column);
    }

    public static function orderByDesc($column){
        return self::db()->orderByDesc($column);
    }

    public function limit($limit, $offset = 0){
        return self::db()->limit($limit, $offset);
    }

    public static function dropIfExists(){
        return self::db()->dropIfExists();
    }

    public static function all(){
        return self::db()->select('*')->getAll();
    }

    public static function find($id){
        return self::db()->select('*')->where('id', $id)->get();
    }
}
?>