<?php

namespace Core;

use \Libs\Config;
use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{	
	protected $db;
	protected $driver = 'default';

	function __construct()
	{
		$this->db = new Capsule;
		
		if (!is_array($this->driver)) 
		{
			$this->db->addConnection([
			    'driver'    => Config::get("$this->driver.driver", 'mysql'),
			    'host'      => Config::get("$this->driver.host", '127.0.0.1'),
			    'database'  => Config::get("$this->driver.database"),
			    'username'  => Config::get("$this->driver.username", ''),
			    'password'  => Config::get("$this->driver.password", ''),
			    'charset'   => Config::get("$this->driver.charset", 'utf8'),
			    'collation' => Config::get("$this->driver.collation", 'utf8_unicode_ci'),
			    'prefix'    => Config::get("$this->driver.prefix", ''),
			]);
		}
		else
		{
			foreach ($this->driver as $key => $driver) 
			{
				$this->db->addConnection([
				    'driver'    => Config::get("$driver.driver", 'mysql'),
				    'host'      => Config::get("$driver.host", '127.0.0.1'),
				    'database'  => Config::get("$driver.database"),
				    'username'  => Config::get("$driver.username", ''),
				    'password'  => Config::get("$driver.password", ''),
				    'charset'   => Config::get("$driver.charset", 'utf8'),
				    'collation' => Config::get("$driver.collation", 'utf8_unicode_ci'),
				    'prefix'    => Config::get("$driver.prefix", ''),
				], $key);
			}
		}

		$this->db->bootEloquent();
	}
	
	function __destruct()
	{
		unset($this->db);
	}
}