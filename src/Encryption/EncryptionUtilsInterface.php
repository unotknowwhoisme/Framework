<?php

namespace Citrus\Encryption;

interface EncryptionUtilsInterface {
    public static function GenerateKey() : string;
    public static function base64url_encode($data) : string;
    public static function base64url_decode($data, $strict = false) : string;
}