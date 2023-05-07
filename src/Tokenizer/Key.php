<?php

namespace Citrus\Tokenizer;

class Key implements KeyInterface {
	public static function dump($params) : bool|string {
		ob_start();

		var_dump($params);

		return ob_get_clean();
	}

	public static function make($params) : string {
		return md5(self::dump($params));
	}
}