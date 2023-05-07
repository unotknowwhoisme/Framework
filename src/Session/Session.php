<?php

namespace Citrus\Session;

class Session implements SessionInterface {
    private $sessionPath = null;
    private $data = [];

    public function __construct($sessionID)
    {
        $this->sessionPath = ROOT_DIR . '/cache/Sessions/' . $sessionID;

        $this->flushOutdatedSessions();

        if(!file_exists($this->sessionPath)) {
            file_put_contents($this->sessionPath, '{}');
        }

        $this->data = json_decode(file_get_contents($this->sessionPath), true);
    }

    public function get($key) : object|string|bool|array|null
    {
        if(!$this->has($key)) return null;
        return $this->data[$key];
    }

    public function has($key) : bool
    {
        return isset($this->data[$key]);
    }

    public function setMulti($arr = []) : void
    {
        foreach($arr as $key=>$value) {
            $this->data[$key] = $value;
        }
        $this->rewrite();
    }

    public function set($key, $value) : void
    {
        $this->data[$key] = $value;
        $this->rewrite();
    }

    private function rewrite() : void
    {
        file_put_contents($this->sessionPath, json($this->data));
    }

    private function flushOutdatedSessions() : void
    {
        $dir = ROOT_DIR . '/cache/Sessions';
        foreach(scandir($dir) as $filename) {
            $path = $dir . '/' . $filename;

            if(!is_file($path)) continue;

            $fileCreationTime = filectime($path);
            $expTime = time() - 60 * 60 * 24; // 1 day

            if($expTime > $fileCreationTime) {
                unlink($path);
            }
        }
    }

    public function flush() : void
    {
        if(file_exists($this->sessionPath)) {
            unlink($this->sessionPath);
        }

        $this->data = [];
    }
}