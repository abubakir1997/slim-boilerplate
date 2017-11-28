<?php

namespace Apps\Middlewares;

use \Libs\Session;
use \Core\Middleware;
use \Apps\Models\Tables\User;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Auth extends Middleware
{	
	public function __invoke(Request $req, Response $res, callable $next) : Response
	{
		$get   = $req->isGet();
		$token = $get 	? Session::get('token', true) 			  : $req->getHeader('Authorization');
		$user  = $token ? User::where('token', $token)->first()   : null;
		$auth  = $user 	? strtotime($user->token_expire) > time() : false;

		if ($get) 
		{
			$redirect = $this->container->router->pathFor('signout');
			return !$auth ? $res->withRedirect($redirect) : $next($req, $res);
		}
		else
		{
			$json = ['error' => 'Invalid Request'];
			return !$auth ? $res->withJson($json) : $next($req, $res);
		}
	}
}