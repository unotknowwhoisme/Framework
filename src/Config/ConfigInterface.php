<?php

namespace Citrus\Config;

interface ConfigInterface {
    public function __construct($filename);
    public function has($key) : bool;
    public function get($key) : string|bool|array|null;
    public function set($key, $value) : void;
}