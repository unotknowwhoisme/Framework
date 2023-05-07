<?php

namespace Citrus\Router\HTTP\Request;

interface RequestInterface {
    public function host() : string;
    public function schema() : string;
    public function uri() : string;
    public function method() : string;
    public function isMethod($method) : bool;
    public function useragent() : string;
    public function header($header=null) : string|array;
    public function ip() : string;
    public function input($var, $default=null) : string;
    public function query($var, $default=null) : string;
    public function validate($query=[]) : bool;
}