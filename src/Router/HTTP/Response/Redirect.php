<?php

namespace Citrus\Router\HTTP\Response;

use \Citrus\CI\CI;

class Redirect implements RedirectInterface {
    public function url($url) : callable
    {
        $callback = function() use($url) {
            if(!headers_sent()) header('Location: ' . $url);
        };

        return $callback;
    }

    public function route($route) : callable
    {
        $router = CI::get('citrus_router');

        foreach($router->getRoutes() as $route) {
            if($route->name() == $route) {
                return $route->getCallback();
            }
        }

        return null;
    }
}