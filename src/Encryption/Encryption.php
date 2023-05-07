<?php

namespace Citrus\Encryption;

use \Citrus\Encryption\EncryptionUtils;

class Encryption implements EncryptionInterface {
    public static function Encrypt($data) : string
    {
        $key = citrus()->config()->get('app')['key'];
        $iv = rand(10000000, 99999999).rand(10000000, 99999999);

        $arr = [
            'payload' => openssl_encrypt($data, 'AES-128-CTR', $key, 0, $iv),
            'iv' => $iv
        ];

        return EncryptionUtils::base64url_encode(json($arr));
    }

    public static function Decrypt($data) : string
    {
        $data = json_decode(EncryptionUtils::base64url_decode($data), true);
        $key = citrus()->config()->get('app')['key'];

        return openssl_decrypt($data['payload'], 'AES-128-CTR', $key, 0, $data['iv']);
    }
}