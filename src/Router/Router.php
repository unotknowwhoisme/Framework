<?php

namespace Citrus\Router;

use \Citrus\Router\RouterHelper;
use \Citrus\Router\Route\BaseRoute;
use \Citrus\Router\Route\BaseRouteInterface;

class Router implements RouterInterface {
    private $routes = [];
    private $events = [];

    public function getRoutes() : array
    {
        return $this->routes;
    }

    public function get($route, $callback) : BaseRouteInterface
    {
        $routeInstance = new BaseRoute($route, $callback);

        $this->routes['GET'][] = $routeInstance;

        return $routeInstance;
    }

    public function post($route, $callback) : BaseRouteInterface
    {
        $routeInstance = new BaseRoute($route, $callback);
        
        $this->routes['POST'][] = $routeInstance;

        return $routeInstance;
    }

    public function on($event, $callback) : BaseRouteInterface
    {
        $routeInstance = new BaseRoute(null, $callback);
        
        $this->events[$event] = $routeInstance;

        return $routeInstance;
    }

    public function emit($event, $params=[]) : bool
    {
        if(!isset($this->events[$event])) return false;

        $e = $this->events[$event];

        $e->handle($params);

        return true;
    }

    public function run() : void
    {
        $numHandled = 0;

        $uri = RouterHelper::getCurrentUri();
        $method = RouterHelper::getRequestMethod();

        $routes = [];

        if(isset($this->routes[$method])) $routes = $this->routes[$method];

        foreach ($routes as $route) {
            $is_match = RouterHelper::patternMatches($route->getRoute(), $uri, $matches, PREG_OFFSET_CAPTURE);

            if ($is_match) {
                $matches = array_slice($matches, 1);

                $params = array_map(function ($match, $index) use ($matches) {
                    if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_array($matches[$index + 1][0])) {
                        if ($matches[$index + 1][0][1] > -1) {
                            return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
                        }
                    }
                    return isset($match[0][0]) && $match[0][1] != -1 ? trim($match[0][0], '/') : null;
                }, $matches, array_keys($matches));

                $route->handle($params);

                ++$numHandled;

                break;
            }
        }

        if($numHandled == 0) {
            $this->emit('not_found');
        }
    }
}