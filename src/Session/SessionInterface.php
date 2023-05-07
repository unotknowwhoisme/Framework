<?php

namespace Citrus\Session;

interface SessionInterface {
    public function __construct($sessionID);
    public function get($key) : object|string|bool|array|null;
    public function has($key) : bool;
    public function setMulti($arr = []) : void;
    public function set($key, $value) : void;
    public function flush() : void;
}