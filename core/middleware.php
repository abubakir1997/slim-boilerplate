<?php

namespace Core;

use \Slim\Container as SlimContainer;

class Middleware
{
	protected $container;

	public function __construct(SlimContainer $c = null)
	{
		$this->container = $c;
	}
}