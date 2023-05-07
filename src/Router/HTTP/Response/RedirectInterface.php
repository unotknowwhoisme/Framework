<?php

namespace Citrus\Router\HTTP\Response;

interface RedirectInterface {
    public function url($url) : callable;
    public function route($route) : callable;
}