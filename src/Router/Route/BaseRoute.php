<?php

namespace Citrus\Router\Route;

use \Citrus\Router\RouterHelper;

class BaseRoute implements BaseRouteInterface {
    private $route_, $callback_, $name_;

    public function __construct($route, $callback)
    {
        $this->route_ = $route;
        $this->callback_ = $callback;
    }

    public function name($val = null) : string
    {
        if($val != null) $this->name_ = $val;
        return $this->name_;
    }

    public function getRoute() : string
    {
        return $this->route_;
    }

    public function getCallback() : callable
    {
        return $this->callback_;
    }

    public function handle($params=[]) : bool
    {
        $callback = $this->getCallback();

        if(!is_callable($callback)) return false;

        $result = call_user_func_array($callback, $params);

        while(is_callable($result)) { $result = call_user_func_array($result, $params); }

        if(is_string($result)) {
            exit($result);
        }

        return true;
    }
}