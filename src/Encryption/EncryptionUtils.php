<?php

namespace Citrus\Encryption;

class EncryptionUtils implements EncryptionUtilsInterface {
    public static function GenerateKey() : string {
        return hash('sha256', md5(random_bytes(32)).md5(random_bytes(32)));
    }

    public static function base64url_encode($data) : string
    {
        $b64 = base64_encode($data);

        if ($b64 === false) {
            return false;
        }

        $url = strtr($b64, '+/', '-_');
        return rtrim($url, '=');
    }

    public static function base64url_decode($data, $strict = false) : string
    {
        $b64 = strtr($data, '-_', '+/');
        
        return base64_decode($b64, $strict);
    }
}