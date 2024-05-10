<?php
namespace TurgunboyevUz\SPDO\Queries;

trait QueryBuilder
{
    protected string $statement = 'select';

    protected array $select = [];
    protected array $where = [];
    protected int $limit, $offset;
    protected array $orderBy = [];

    protected array $columns = [];

    protected string $queryString;
    protected array $params = [];

    public function build()
    {
        //------------CREATE------------
        if ($this->statement == 'insert') {
            $this->queryString = "INSERT INTO `$this->table` " . $this->prepareInsertParams($this->columns);
            $this->params = $this->columns;
        }

        //-------------READ-------------
        if ($this->statement == 'select') {
            if (empty($this->select)) {
                $select = '*';
            } else {
                $select = implode(', ', $this->select);
            }

            $this->queryString = "SELECT $select FROM `$this->table`";
        }

        //-------------UPDATE-------------
        if ($this->statement == 'update') {
            $updateParams = $this->prepareUpdateParams($this->columns);

            $this->queryString = "UPDATE `$this->table` SET " . $updateParams['query'];
            $this->params = $updateParams['binds'];
        }

        //-------------DELETE-------------
        if ($this->statement == 'delete') {
            $this->queryString = "DELETE FROM `$this->table`";
        }

        if (!empty($this->where)) {
            $whereParams = $this->prepareWhereParams($this->where);

            $this->queryString .= ' WHERE ' . $whereParams['query'];
            $this->params = array_merge($this->params, $whereParams['binds']);
        }

        if (!empty($this->orderBy)) {
            $this->queryString .= ' ORDER BY ';
            foreach ($this->orderBy as $by) {
                $this->queryString .= "`{$by['column']}` {$by['order']} ";
            }
        }

        if (!empty($this->limit)) {
            $this->queryString .= " LIMIT $this->limit OFFSET $this->offset";
        }

        return $this;
    }

    public function insert(array $values)
    {
        $this->statement = 'insert';
        $this->columns = $values;

        return $this->do();
    }

    public function select(...$columns)
    {
        $this->select = $columns;

        return $this->do();
    }

    public function update(array $values)
    {
        $this->statement = 'update';
        $this->columns = $values;

        return $this->do();
    }

    public function delete()
    {
        $this->statement = 'delete';
        
        return $this->do();
    }

    public function where($columns, $value)
    {
        if (is_array($columns)) {
            $this->where = $columns;
        } else {
            $this->where[$columns] = $value;
        }

        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->limit = $limit;
        $this->offset = $offset;

        return $this;
    }

    public function orderByAsc($column)
    {
        $this->orderBy[] = [
            'column' => $column,
            'order' => 'ASC',
        ];

        return $this;
    }

    public function orderByDesc($column)
    {
        $this->orderBy[] = [
            'column' => $column,
            'order' => 'DESC',
        ];

        return $this;
    }

    //-------------PREPARE-------------
    public function randomToken($length = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charLength = 62;

        $token = '';

        for ($i = 0; $i < ($length - 1); $i++) {
            $token .= $characters[rand(0, $charLength - 1)];
        }

        return 't' . $token;
    }

    public function prepareInsertParams($params)
    {
        $keys = array_keys($params);

        return "(" . implode(', ', $keys) . ") VALUES (" . ':' . implode(', :', $keys) . ")";
    }

    public function prepareUpdateParams($params)
    {
        $query = '';
        $binds = [];

        foreach ($params as $column => $value) {
            $paramName = $column . '_' . $this->randomToken();

            $query .= "`$column` = :$paramName, ";
            $binds[$paramName] = $value;
        }

        $query = substr($query, 0, -2);

        return [
            'query' => $query,
            'binds' => $binds,
        ];
    }

    public function prepareWhereParams($params)
    {
        $query = '';
        $binds = [];

        foreach ($params as $column => $value) {
            $paramName = $column . '_' . $this->randomToken();

            $query .= "`$column` = :$paramName AND ";
            $binds[$paramName] = $value;
        }

        $query = substr($query, 0, -5);

        return [
            'query' => $query,
            'binds' => $binds,
        ];
    }
}
