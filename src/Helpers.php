<?php

use \Citrus\ApplicationInterface;
use \Citrus\CI\CI;
use \Citrus\Database\DatabaseInterface;
use \Citrus\Router\HTTP\Response\JSON;
use \Citrus\Router\HTTP\Response\RedirectInterface;
use \Citrus\Router\HTTP\Request\RequestInterface;
use \Citrus\Router\RouterInterface;
use \Citrus\Session\SessionInterface;
use \Citrus\Views\Views;

if(!function_exists('citrus')) {
    function citrus() : ApplicationInterface {
        return CI::get('citrus');
    }
}

if(!function_exists('request')) {
    function request() : RequestInterface {
        return citrus()->request();
    }
}

if(!function_exists('redirect')){
    function redirect() : RedirectInterface {
        return citrus()->redirect();
    }
}

if(!function_exists('json')) {
    function json($arr=[]) : string {
        return JSON::ArrToString($arr);
    }
}

if(!function_exists('router')) {
    function router() : RouterInterface {
        return citrus()->router();
    }
}

if(!function_exists('session')) {
    function session() : SessionInterface {
        return citrus()->session();
    }
}

if(!function_exists('view')) {
    function view($filename, $data=[]) : string {
        return Views::Render($filename, $data);
    }
}

if(!function_exists('database')) {
    function database() : DatabaseInterface {
        return citrus()->database();
    }
}