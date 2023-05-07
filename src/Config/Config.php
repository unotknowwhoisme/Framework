<?php

namespace Citrus\Config;

use \Citrus\Encryption\EncryptionUtils;

class Config implements ConfigInterface {
    private $config = null;
    private $filename_;

    public function __construct($filename)
    {
        $this->filename_ = $filename;

        if(file_exists($filename)) {
            $this->config = json_decode(file_get_contents($filename), true);
        } else {
            $this->config = [
                'app' => [
                    'title' => 'Citrus Core',
                    'key' => EncryptionUtils::GenerateKey()
                ],
                'core' => [
                    'cache' => false
                ],
                'database' => [
                    'type' => 'mysql',
                    'host' => 'localhost',
                    'database' => 'citrus',
                    'username' => 'root',
                    'password' => '',
                    'port' => 3306
                ]
            ];

            $this->update();
        }
    }

    private function update() : void
    {
        file_put_contents($this->filename_, json($this->config));
    }

    public function has($key) : bool
    {
        return isset($this->config[$key]);
    }
    public function get($key) : string|bool|array|null
    {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    public function set($key, $value) : void
    {
        $this->config[$key] = $value;
        $this->update();
    }
}