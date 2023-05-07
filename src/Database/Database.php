<?php

namespace Citrus\Database;

use \Citrus\Database\Objects\Table;
use \Citrus\Database\Objects\TableInterface;
use \Medoo\Medoo;

class Database implements DatabaseInterface {
    private $worker = null;
    private $tables = [];

    public function __construct()
    {
        $this->worker = new Medoo(citrus()->config()->get('database'));
    }

    public function table($name) : TableInterface
    {
        if(!isset($this->tables[$name])) {
            $this->tables[$name] = new Table($name, $this->worker);
        }
        
        return $this->tables[$name];
    }
}