<?php

namespace Citrus\Database\Objects;

use PDOStatement;

class Table implements TableInterface {
    private $name_ = null, $worker_ = null;

    public function __construct($name, $worker)
    {
        $this->name_ = $name;
        $this->worker_ = $worker;
    }
    
    public function select($join, $columns = null, $where = null) : ?array
    {
        return $this->worker_->select($this->name_, $join, $columns, $where);
    }

    public function insert($values = [], string $primaryKey = null) : ?PDOStatement
    {
        return $this->worker_->insert($this->name_, $values, $primaryKey);
    }

    public function update($data, $where = null) : ?PDOStatement
    {
        return $this->worker_->update($this->name_, $data, $where);
    }

    public function delete($where) : ?PDOStatement
    {
        return $this->worker_->delete($this->name_, $where);
    }
}