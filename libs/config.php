<?php

namespace Libs;

class Config
{
	static $configs;

	public static function get(string $name, $default = null)
	{
		return isset(self::$configs[APP_ENV][$name]) ? self::$configs[APP_ENV][$name] : $default;
	}

	public static function set($name, $value) 
	{
		self::$configs[APP_ENV][$name] = $value;
	}
}