<?php

namespace Citrus\Views;

interface ViewsInterface {
    public static function Render($filename, $data=[]) : string;
}