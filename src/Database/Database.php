<?php
namespace TurgunboyevUz\SPDO\Database;

use TurgunboyevUz\SPDO\Queries\QueryBuilder;
use TurgunboyevUz\SPDO\Queries\QueryExecutor;
use TurgunboyevUz\SPDO\Exception\DatabaseException;

use PDOStatement;
use PDO;

class Database{    
    protected PDO $conn;
    protected PDOStatement $stmt;

    protected string $table;

    use QueryBuilder;
    use QueryExecutor;

    public function __construct(PDO $connection, $table)
    {
        $this->conn = $connection;
        $this->table = $table;
    }

    public function query($query, $params = []){
        $this->stmt = $this->conn->prepare($query);

        if($this->stmt->execute($params)){
            return $this;
        }else{
            throw new DatabaseException($this->stmt->errorInfo()[2], $this->stmt->errorInfo()[1]);

            return $this;
        }
    }

    public function dropIfExists(){
        return $this->query("DROP TABLE IF EXISTS `$this->table`");
    }
}
