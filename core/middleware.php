<?php

namespace Core;

use \Slim\Container as SlimContainer;

class Middleware
{
	protected $router;
	protected $jwt;

	public function __construct(SlimContainer $c = null)
	{
		$this->jwt = $c->jwt;
		$this->router = $c->router;
	}
}