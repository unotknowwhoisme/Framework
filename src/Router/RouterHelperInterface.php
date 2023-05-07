<?php

namespace Citrus\Router;

interface RouterHelperInterface {
    public static function getCurrentUri() : string;
    public static function getRequestHeaders() : array;
    public static function getRequestMethod() : string;
    public static function patternMatches($pattern, $uri, &$matches, $flags) : bool;
}