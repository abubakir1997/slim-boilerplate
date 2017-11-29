<?php

namespace Apps\Middlewares;

use \Libs\Session;
use \Libs\Config;
use \Core\Middleware;
use \Apps\Models\Tables\User;

use \Firebase\JWT\JWT as Token;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Auth extends Middleware
{	
	public function __invoke(Request $req, Response $res, callable $next) : Response
	{
		$auth = $this->verify($req);

		if ($req->isGet())
		{
			$redirect = $this->container->router->pathFor('signout');
			return !$auth ? $res->withRedirect($redirect) : $next($req, $res);
		}
		else
		{
			$json = ['error' => 'Token not Found'];
			return !$auth ? $res->withJson($json) : $next($req, $res);
		}
	}

	public function verify(Request $req)
	{
		$secret = Config::get('app.secret', '');
		$header = sizeof($req->getHeader('Authorization')) > 1;
		$token  = $header ? $req->getHeader('Authorization') : Session::get('jwtToken', true);

		$decode = isset($token)  ? Token::decode($token, $secret, ['HS256']) : null;
		$user   = isset($decode) ? User::find($decode->user) : null;
		$auth   = isset($user)   ? strtotime($decode->expire) > time() : false;
		
		$this->container->jwt = $decode;
		
		return $auth;
	}
}