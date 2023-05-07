<?php

namespace Citrus\Views;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment as TwigEnvironment;
use \Twig\TwigFunction;

class Views implements ViewsInterface {
    public static function Render($filename, $data=[]) : string
    {
        $cache = citrus()->config()->get('core')['cache'];

        $loader = new FilesystemLoader(APP_DIR . '/Views');
        $twig = new TwigEnvironment($loader, [
            'cache' => $cache ? ROOT_DIR . '/cache/Views' : false
        ]);

        $twig->addFunction(new TwigFunction('asset', function($file) {
            $request = citrus()->request();
            return $request->schema().'://'.$request->host().'/'.$file;
        }));

        $twig->addFunction(new TwigFunction('config', function($key) {
            return citrus()->config()->get($key);
        }));

        return $twig->render($filename, $data);
    }
}