<?php

namespace Citrus\Database\Objects;

use PDOStatement;

interface TableInterface {
    public function __construct($name, $worker);
    public function select($join, $columns = null, $where = null) : ?array;
    public function insert($values = [], string $primaryKey = null) : ?PDOStatement;
    public function update($data, $where = null) : ?PDOStatement;
    public function delete($where) : ?PDOStatement;
}