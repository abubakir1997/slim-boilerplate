<?php

namespace Libs;

class Helpers
{
	public static function print_f($var)
	{
		print "<pre>";
		print_r($var);
		print "</pre>";
	}

	public static function hash($x) : string
	{
		return md5($x . Config::get('app.salt', ''));
	}
}