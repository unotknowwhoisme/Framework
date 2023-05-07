<?php

namespace Citrus\Router\Route;

interface BaseRouteInterface {
    public function __construct($route, $callback);
    public function name($val = null) : string;
    public function getRoute() : string;
    public function getCallback() : callable;
    public function handle($params=[]) : bool;
}