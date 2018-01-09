<?php

namespace Core;

use \Slim\Container as SlimContainer;

abstract class Controller
{
	protected $view;
	protected $router;
	protected $flash;
	protected $logger;
	
	function __construct(SlimContainer $c)
	{
		$this->view   = $c->view;
		$this->router = $c->router;
		$this->flash  = $c->flash;
		$this->logger = $c->logger;
	}
}