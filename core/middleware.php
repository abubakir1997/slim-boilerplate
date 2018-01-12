<?php

namespace Core;

use \Slim\Container;

class Middleware
{
	protected $router;
	protected $jwt;

	public function __construct(Container $c = null)
	{
		$this->jwt = $c->jwt;
		$this->router = $c->router;
	}
}