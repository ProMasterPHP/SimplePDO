<?php
namespace TurgunboyevUz\SPDO\Queries;

trait QueryExecutor{
    //------------QUERY EXECUTOR------------
    public function fetch(){
        return $this->stmt->fetch();
    }

    public function fetchAll(){
        return $this->stmt->fetchAll();
    }

    public function count(){
        if(!isset($this->stmt)){ $this->do(); }

        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->conn->lastInsertId();
    }

    //------------EXECUTE SIMPLIFIER------------
    public function do(){
        return $this->build()->query($this->queryString, $this->params);
    }

    public function get(){
        if($this->count() == 0){
            return false;
        }

        return $this->fetch();
    }

    public function getAll(){
        if($this->count() == 0){
            return false;
        }

        return $this->fetchAll();
    }
}
?>