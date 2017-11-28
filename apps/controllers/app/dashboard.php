<?php

namespace Apps\Controllers\App;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Dashboard extends Controller
{
	public function get(Request $req, Response $res) : Response
	{
		return $this->view->render($res, 'app/dashboard.twig');
	}
}