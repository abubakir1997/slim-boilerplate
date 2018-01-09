<?php

namespace Controllers\Web;

use \Libs\Config;
use \Libs\Helpers;
use \Libs\Session;
use \Core\Controller;
use \Models\User;

use \Firebase\JWT\JWT as Token;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class SignController extends Controller
{
	public function get(Request $req, Response $res) : Response
	{	
		return $this->view->render($res, 'web/signin.twig');
	}

	public function post(Request $req, Response $res) : Response
	{
		$user = User::where([
			['username', $req->getParam('username')],
			['password', Helpers::hash($req->getParam('password'))]
		])->first();

		if ($user)
		{
			$secret  = Config::get('app.secret', '');
			$keep    = boolval($req->getParam('keep'));
			$store   = $keep ? '+1 years' : '+8 hours';
			$info 	 = ['username' => $user->username];
			$payload = [
				'user'   => $user->id,
				'expire' => date("Y-m-d H:i:s", strtotime($store))
			];
			
			Session::set('jwtToken', Token::encode($payload, $secret), $keep);
			Session::set('user', $info);
			$redirect = $this->router->pathFor('dashboard');
		}
		else
		{
			$redirect = $this->router->pathFor('signin');
			$this->flash->addMessage('error','Incorrect Username or Password');
			$res->withStatus(302);
		}

		return $res->withRedirect($redirect);
	}

	public function destroy(Request $req, Response $res) : Response
	{
		Session::destory();
		$redirect = $this->router->pathFor('signin');
		return $res->withRedirect($redirect);
	}
}