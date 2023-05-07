<?php

namespace Citrus;

use \Citrus\CI\CI;
use \Citrus\Config\Config;
use \Citrus\Config\ConfigInterface;
use \Citrus\Database\Database;
use \Citrus\Database\DatabaseInterface;
use \Citrus\Router\HTTP\Request\Request;
use \Citrus\Router\HTTP\Request\RequestInterface;
use \Citrus\Router\HTTP\Response\Redirect;
use \Citrus\Router\HTTP\Response\RedirectInterface;
use \Citrus\Router\Router;
use \Citrus\Router\RouterInterface;
use \Citrus\Session\Session;
use \Citrus\Session\SessionHelper;
use \Citrus\Session\SessionInterface;

class Application implements ApplicationInterface {
    public function __construct()
    {
        CI::set('citrus_config', new Config(APP_DIR . '/Application.json'));
    }

    public function config() : ConfigInterface
    {
        return CI::get('citrus_config');
    }

    public function request() : RequestInterface
    {
        return CI::get('citrus_request');
    }

    public function redirect() : RedirectInterface
    {
        return CI::get('citrus_redirect');
    }

    public function router() : RouterInterface
    {
        return CI::get('citrus_redirect');
    }

    public function session() : SessionInterface
    {
        return CI::get('citrus_session');
    }
    
    public function database() : DatabaseInterface
    {
        return CI::get('citrus_database');
    }

    public static function install() : void
    {
        $dirnames = [
            '/app',
            '/app/Controllers',
            '/app/Models',
            '/app/Routes',
            '/app/Views',
            '/app/Views/Layouts',
            '/cache',
            '/cache/Sessions',
            '/cache/Views'
        ];

        foreach($dirnames as $dir) {
            $path = ROOT_DIR . $dir;
            if(!file_exists($path)) {
                mkdir($path);
            }
        }

        define('APP_DIR', ROOT_DIR . '/app');

        CI::set('citrus', new self());
        CI::set('citrus_request', new Request());
        CI::set('citrus_redirect', new Redirect());
        CI::set('citrus_router', new Router());
        CI::set('citrus_session', new Session(SessionHelper::GetID()));
        CI::set('citrus_database', new Database());
    }

    public static function run() : void
    {
        if(CI::has('citrus_router')) {
            CI::get('citrus_router')->run();
        }
    }
}