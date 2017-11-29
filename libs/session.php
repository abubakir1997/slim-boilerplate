<?php

namespace Libs;

class Session
{
	public static function init() 
	{
		if (session_status() === PHP_SESSION_NONE) 
		{
			session_start();
		}
	}

	public static function set(string $key, $value, bool $keep = false, int $days = 365)
	{
		if (!$keep) 
		{
			$_SESSION[$key] = $value;
		}
		else
		{
			setcookie("app-$key", $value, time() + (86400 * $days), '/');
		}
	}
	
	public static function get(string $key, bool $deep = false)
	{
		if (!$deep) 
		{
			return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
		}
		else
		{
			if (isset($_SESSION[$key])) 
			{
				return $_SESSION[$key];
			}

			return isset($_COOKIE["app-$key"]) ? $_COOKIE["app-$key"] : null; 
		}
	}

	public static function destory()
	{
		session_destroy();

		if (sizeof($_COOKIE) > 1)
		{
			$cookies = array_filter($_COOKIE, function($key) {
				return strpos($key, 'app-') === 0;
		 	}, ARRAY_FILTER_USE_KEY);

	    	foreach($cookies as $name => $value) 
	    	{
	    		setcookie($name, null, time() - 3600);
		    }
		}
	}
}