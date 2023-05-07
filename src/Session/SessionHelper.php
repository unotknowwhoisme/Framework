<?php

namespace Citrus\Session;

use \Citrus\Tokenizer\Key;

class SessionHelper implements SessionHelperInterface {
    public static function GetID() : string
    {
        return hash('sha256', Key::make(request()->ip()).Key::make(request()->useragent()));
    }
}