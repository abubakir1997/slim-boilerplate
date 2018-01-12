<?php

namespace Core;

use \Slim\Container;

abstract class Controller
{
	protected $view;
	protected $router;
	protected $flash;
	protected $logger;
	
	function __construct(Container $c)
	{
		$this->view   = $c->view;
		$this->router = $c->router;
		$this->flash  = $c->flash;
		$this->logger = $c->logger;
	}
}