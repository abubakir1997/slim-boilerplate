<?php

namespace Apps\Middlewares;

use \Libs\Session;
use \Apps\Models\Tables\User;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Guest extends Auth
{	
	public function __invoke(Request $req, Response $res, callable $next) : Response
	{
		$auth = $this->verify($req);
		$app  = $this->container->groupPath('app');

		return $auth ? $res->withRedirect($app) : $next($req, $res);
	}
}