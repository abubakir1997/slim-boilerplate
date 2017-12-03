<?php

namespace Controllers\Site;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Home extends Controller
{	
	public function get(Request $req, Response $res) : Response
	{
		return $this->view->render($res, 'site/home.twig');
	}
}