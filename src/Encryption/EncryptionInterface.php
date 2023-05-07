<?php

namespace Citrus\Encryption;

interface EncryptionInterface {
    public static function Encrypt($data) : string;
    public static function Decrypt($data) : string;
}