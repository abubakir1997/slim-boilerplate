<?php

namespace Controllers\Web;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ErrorController extends Controller
{	
	public static function notFound(Request $req, Response $res) : Response
	{
		return $this->view->render($res->withStatus(404), 'web/error.twig', [
			'code' => 404,
			'route' => $req->getUri()
		]);
	}

	public static function notAllowed(Request $req, Response $res) : Response
	{
		return $this->view->render($res->withStatus(403), 'web/error.twig', [
			'code' => 403,
			'route' => $req->getUri()
		]);
	}
}