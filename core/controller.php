<?php

namespace Core;

use \Slim\Router as SlimRouter;
use \Slim\Views\Twig as SlimTwig;
use \Slim\Flash\Messages as SlimFlash;
use \Monolog\Logger as MonologLogger;

abstract class Controller
{	
	protected $view;
	protected $router;
	protected $flash;
	protected $model;
	protected $table;
	protected $logger;
	
	function __construct(SlimTwig $view, SlimRouter $router, SlimFlash $flash, MonologLogger $logger)
	{
		$this->view   = $view;
		$this->router = $router;
		$this->flash  = $flash;
		$this->logger = $logger;

		/**
		* Type: String
		* Option: Inherit Name
		* Reference: Model Class
		*/
		$model = "\\".str_replace('Controllers', 'Models', self::getClassName());

		if(class_exists($model))
		{
			$this->model  = new $model;
		}

		/**
		* Type: String
		* Option: Custom Name
		* Reference: Table Class
		*/
		if (isset($this->table))
		{
			$table = "\Models\Tables\\$this->table";

			if (class_exists($table))
			{
				$this->table  = new $table;
			}
		}
	}

	public static function getClassName()
	{
		return get_called_class();
	}
}