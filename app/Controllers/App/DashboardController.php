<?php

namespace Controllers\App;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class DashboardController extends Controller
{
	public function get(Request $req, Response $res) : Response
	{
		return $this->view->render($res, 'layout/app.twig', [
			'app' => 'dashboard'
		]);
	}
}