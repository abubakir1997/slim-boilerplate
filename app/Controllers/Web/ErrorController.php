<?php

namespace Controllers\Web;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/*
|--------------------------------------------------------------------------
| Error Handler
|--------------------------------------------------------------------------
|
| DO NOT CHANGE METHOD NAMES
|
| The following class is manages the different error types. Feel free
| to edit the content of the methods, however, do not change the method
| names. The following are the different error handlers:
|
| errorHandler 		=> Default error handler (Status 500)
| phpErrorHandler 	=> Runtime errors (Status 500)
| notFound 			=> Attempts to access undefined routes (Status 404)
| notAllowed 		=> Unauthorized access to protected routes (Status 405)
|
*/

class ErrorController extends Controller
{
	public function errorHandler(Request $req, Response $res) : Response
	{
		return $res->withStatus(500)->write('Something Went Wrong!');
	}

	public function phpErrorHandler(Request $req, Response $res) : Response
	{
		return $res->withStatus(500)->write('Request Time Out!');
	}

	public function notFound(Request $req, Response $res) : Response
	{
		return $this->view->render($res->withStatus(404), 'web/error.twig', [
			'code' => 404,
			'route' => $req->getUri()
		]);
	}

	public function notAllowed(Request $req, Response $res) : Response
	{
		return $this->view->render($res->withStatus(405), 'web/error.twig', [
			'code' => 405,
			'route' => $req->getUri()
		]);
	}
}