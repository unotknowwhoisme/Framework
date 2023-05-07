<?php

namespace Citrus;

use \Citrus\Config\ConfigInterface;
use \Citrus\Database\DatabaseInterface;
use \Citrus\Router\HTTP\Request\RequestInterface;
use \Citrus\Router\HTTP\Response\RedirectInterface;
use \Citrus\Router\RouterInterface;
use \Citrus\Session\SessionInterface;

interface ApplicationInterface {
    public function __construct();
    public function config() : ConfigInterface;
    public function request() : RequestInterface;
    public function redirect() : RedirectInterface;
    public function router() : RouterInterface;
    public function session() : SessionInterface;
    public function database() : DatabaseInterface;
    public static function install() : void;
    public static function run() : void;
}