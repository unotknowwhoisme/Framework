<?php

namespace Citrus\CI;

use \Citrus\Tokenizer\Key;

class CI implements CIInterface {
    private static $storage = [];

	public static function has($name) : bool {
		return (isset(self::$storage[Key::make($name)]));
	}

	public static function get($name) : object|null {
		$key = Key::make($name);

		if(!self::has($name)){
			return null;
		}

		return self::$storage[$key];
	}

	public static function set($name, $value) : object {
		$key = Key::make($name);

		self::$storage[$key] = $value;

		return $value;
	}
}