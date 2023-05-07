<?php

namespace Citrus\Database;

use \Citrus\Database\Objects\TableInterface;

interface DatabaseInterface {
    public function __construct();
    public function table($name) : TableInterface;
}