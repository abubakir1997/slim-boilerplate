<?php

namespace Apps\Controllers\Site;

use \Libs\Helpers;
use \Libs\Session;
use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Sign extends Controller
{
	protected $table = 'User';

	public function get(Request $req, Response $res) : Response
	{	
		return $this->view->render($res, 'site/signin.twig');
	}

	// ------------------------------------------------------
	// ********************* Actions ************************
	// ------------------------------------------------------

	public function post(Request $req, Response $res) : Response
	{
		$user = $this->table->where([
			['username', $req->getParam('username')],
			['password', Helpers::hash($req->getParam('password'))]
		])->first();

		if ($user)
		{
			$keep  = boolval($req->getParam('keep'));
			$store = $keep ? '+30 days' : '+1 hours';

			$user->token = bin2hex(openssl_random_pseudo_bytes(8));
			$user->token_expire = date("Y-m-d H:i:s", strtotime($store));
			$user->save();
			Session::set('token', $user->token, $keep);
			Session::set('expire', $user->token_expire);
			Session::set('user', [
				'username' => $user->username
			]);
			
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
		$user = $this->table->where(
			'token', 
			Session::get('token', true)
		)->first();

		if ($user)
		{
			$user->token = null;
			$user->token_expire = null;
			$user->save();
		}

		Session::destory();

		$redirect = $this->router->pathFor('signin');
		return $res->withRedirect($redirect);
	}
}