<?php

namespace Citrus\Tokenizer;

interface KeyInterface {
	public static function dump($params) : bool|string;
	public static function make($params) : string;
}