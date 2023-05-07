<?php

namespace Citrus\Router\HTTP\Response;

class JSON implements JSONInterface {
    public static function ArrToString($arr=[]) : string
    {
        return json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}