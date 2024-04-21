<?php
namespace TurgunboyevUz\SimplePDO;

use TurgunboyevUz\SimplePDO\Database;

class Model{
    protected static $table;

    public static function query($query, $params = []){
        $db = new Database(Database::connection(), static::$table);

        return $db->query($query, $params);
    }
    /**
     * Selects data from the database table based on the given criteria.
     *
     * @param string|array $values The columns to select. Defaults to an empty array.
     * @param array $where The conditions to apply in the WHERE clause. Defaults to an empty array.
     * @param mixed $limit The limit and offset for the query. Defaults to an empty array.
     * @param array $order_by The column and direction to order the results by. Defaults to an empty array.
     * @return mixed $this.
     */
    public static function select($values = [], array $where = [], mixed $limit = [], array $order_by = []){
        $db = new Database(Database::connection(), static::$table);

        return $db->select($values, $where, $limit, $order_by);
    }

    /**
     * Inserts a new record into the table specified by $this->table.
     *
     * @param array $params An associative array where the keys are the column names and the values are the values to be inserted.
     * @return mixed $this
     */
    public static function insert($params){
        $db = new Database(Database::connection(), static::$table);
        return $db->insert($params);
    }

    /**
     * Updates records in the table specified by $this->table based on the given parameters.
     *
     * @param array $params An associative array where the keys are the column names and the values are the new values to be updated.
     * @param array $where An optional array of conditions to apply in the WHERE clause. Defaults to $this->where.
     * @return mixed $this.
     */
    public static function update($params, $where = []){
        $db = new Database(Database::connection(), static::$table);
        return $db->update($params, $where);
    }

    /**
     * Deletes records from the table specified by $this->table based on the given conditions.
     *
     * @param array $where An optional array of conditions to apply in the WHERE clause. Defaults to $this->where.
     * @return mixed $this The current instance of the class.
     */
    public static function delete($where = []){
        $db = new Database(Database::connection(), static::$table);
        return $db->delete($where);
    }

    /**
     * Drops a table if it exists.
     *
     * @return mixed $this The result of the query execution.
     */
    public static function dropIfExists(){
        $db = new Database(Database::connection(), static::$table);
        return $db->dropIfExists();
    }
}
?>