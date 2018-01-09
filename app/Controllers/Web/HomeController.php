<?php

namespace Controllers\Web;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class HomeController extends Controller
{	
	public function get(Request $req, Response $res) : Response
	{
		return $this->view->render($res, 'web/home.twig');
	}
}