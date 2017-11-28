<?php

namespace Apps\Middlewares;

use \Libs\Session;
use \Core\Middleware;
use \Apps\Models\Tables\User;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Guest extends Middleware
{	
	public function __invoke(Request $req, Response $res, callable $next) : Response
	{
		$token = Session::get('token', true);
		$user  = $token ? User::where('token', $token)->first()   : null;
		$auth  = $user  ? strtotime($user->token_expire) > time() : false;
		$app   = $this->container->groupPath('app');

		return $auth ? $res->withRedirect($app) : $next($req, $res);
	}
}