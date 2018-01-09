<?php

namespace Controllers\App;

use \Core\Controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ExampleController extends Controller
{
	public function example(Request $req, Response $res) : Response
	{
	}
}