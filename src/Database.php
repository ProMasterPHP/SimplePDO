<?php
namespace TurgunboyevUz\SimplePDO;

use PDO;
use Exception;

class Database
{
    protected $stmt, $conn;
    public $table, $where;
    public static $database;
    public function __construct(PDO $connection, $table)
    {
        $this->conn = $connection;
        $this->table = $table;
    }

    public static function connect($dbtype, $dsn_param, $username, $password)
    {
        $dsn = $dbtype . ':' . http_build_query($dsn_param, '', ';');

        self::$database = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public static function connection(){
        return self::$database;
    }

    /**
     * @param string $query Query that will be executed
     * @param array $params Params that will be passed to the query
     * @return $this
     */
    public function query(string $query, array $params = []){
        $stmt = $this->conn->prepare($query);
        
        if($stmt->execute($params)){
            $this->stmt = $stmt;

            return $this;
        }else{
            throw new Exception(json_encode([
                'code'=>$stmt->errorCode(),
                'description'=>$stmt->errorInfo()
            ]));
        }
    }

    public function fetch(){
        return $this->stmt->fetch();
    }

    public function fetchAll(){
        return $this->stmt->fetchAll();
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertID(){
        return $this->conn->lastInsertId();
    }

    /**
     * @param string $table
     * @param string|array $values
     * @param array $where
     * @param mixed $limit 0 => limit, 1 => offset
     * @param array $order_by 0 => column, 1 => direction
     * @return $this
     */
    public function select($values = [], array $where = [], mixed $limit = [], array $order_by = []){
        $this->where = $where;

        if(is_array($values)){
            $value = empty($values) ? '*' : implode(', ', $values);
        }else{
            $value = $values;
        }
        
        $query = "SELECT ".implode(', ', $values)." FROM `{$this->table}`";

        if(!empty($where)){
            $query .= " WHERE " . $this->prepareWhereParams($where);
        }

        if(!empty($limit)){
            if(is_array($limit)){
                $query .= " LIMIT " . $limit[0] . ", " . $limit[1];
            }else{
                $query .= " LIMIT " . $limit;
            }
        }

        if(!empty($order_by)){
            $query .= " ORDER BY " . $order_by[0] . $order_by[1];
        }

        $query .= ";";
        return $this->query($query, $where);
    }

    /**
     * Inserts a new record into the table specified by $this->table.
     *
     * @param array $params An associative array where the keys are the column names and the values are the values to be inserted.
     * @return mixed $this
     */
    public function insert($params){
        $columns = "";
        $values = "";

        foreach($params as $key => $value){
            $columns .= "$key, ";
            $values .= ":$key, ";
        }

        return $this->query("INSERT INTO `{$this->table}` (".rtrim($columns, ', ').") VALUES (".rtrim($values, ', ').")", $params);
    }

    /**
     * Updates records in the table specified by $this->table based on the given parameters.
     *
     * @param array $params An associative array where the keys are the column names and the values are the new values to be updated.
     * @param array $where An optional array of conditions to apply in the WHERE clause. Defaults to $this->where.
     * @return mixed $this.
     */
    public function update($params, $where = []){
        $query = "UPDATE `{$this->table}` SET " . $this->prepareUpdateParams($params);

        $where = !empty($where) ? $where : $this->where;

        if(!empty($where)){
            $query .= " WHERE " . $this->prepareWhereParams($where);   
        }

        $query .= ";";

        return $this->query($query, array_merge($params, $where));
    }

    /**
     * Deletes records from the table specified by $this->table based on the given conditions.
     *
     * @param array $where An optional array of conditions to apply in the WHERE clause. Defaults to $this->where.
     * @return mixed $this The current instance of the class.
     */
    public function delete($where = []){
        $query = "DELETE FROM `{$this->table}`";

        $where = !empty($where) ? $where : $this->where;

        if(!empty($where)){
            $query .= " WHERE " . $this->prepareWhereParams($where);   
        }else{
            $query .= " WHERE 1";
        }
        
        $query .= ";";

        return $this->query($query, $where);
    }

    /**
     * Drops a table if it exists.
     *
     * @return mixed $this The result of the query execution.
     */
    public function dropIfExists(){
        return $this->query("DROP TABLE IF EXISTS `{$this->table}`;");
    }

    private function prepareUpdateParams($params){
        $str = "";
        foreach($params as $key => $value){
            $str .= "{$key} = :{$key}, ";
        }

        return rtrim($str, ', ');
    }

    private function prepareWhereParams($params){
        $str = "";
        foreach($params as $key => $value){
            $str .= "{$key} = :{$key} AND ";
        }

        return rtrim($str, ' AND ');
    }
}
?>