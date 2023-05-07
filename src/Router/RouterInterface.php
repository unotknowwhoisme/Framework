<?php

namespace Citrus\Router;

use \Citrus\Router\Route\BaseRouteInterface;

interface RouterInterface {
    public function getRoutes() : array;
    public function get($route, $callback) : BaseRouteInterface;
    public function post($route, $callback) : BaseRouteInterface;
    public function on($event, $callback) : BaseRouteInterface;
    public function emit($event) : bool;
    public function run() : void;
}