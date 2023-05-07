<?php

namespace Citrus\CI;

interface CIInterface {
	public static function get($name) : object|null;
	public static function set($name, $value) : object;
	public static function has($name) : bool;
}