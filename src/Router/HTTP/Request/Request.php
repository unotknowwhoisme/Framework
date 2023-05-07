<?php

namespace Citrus\Router\HTTP\Request;

use \Citrus\Router\RouterHelper;
use \Citrus\Validator\Validator;

class Request implements RequestInterface {
    public function host() : string
    {
        return $this->header('Host');
    }

    public function schema() : string
    {
        return $_SERVER['REQUEST_SCHEME'];
    }

    public function uri() : string
    {
        return RouterHelper::getCurrentUri();
    }

    public function method() : string
    {
        return RouterHelper::getRequestMethod();
    }

    public function isMethod($method) : bool
    {
        return ($this->method() == $method);
    }

    public function useragent() : string
    {
        return $this->header('User-Agent');
    }

    public function header($header=null) : string|array
    {
        $headers = RouterHelper::getRequestHeaders();

        if($header == null) return $headers;

        if(isset($headers[$header])) return $headers[$header];

        return null;
    }

    public function ip() : string
    {
        $ip = '0.0.0.0';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function input($var, $default=null) : string
    {
        if(!isset($_POST[$var])) return $default;
        return $_POST[$var];
    }

    public function query($var, $default=null) : string
    {
        if(!isset($_GET[$var])) return $default;
        return $_GET[$var];
    }

    public function validate($arr=[]) : bool
    {
        $query = ($this->method() == 'GET') ? $_GET : $_POST;

        return Validator::validate($query, $arr);
    }
}