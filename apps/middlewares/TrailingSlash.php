<?php

namespace Apps\Middlewares;

use \Core\Middleware;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class TrailingSlash extends Middleware
{
	public function __invoke(Request $req, Response $res, callable $next) : Response
	{
		$uri = $req->getUri();
	    $path = $uri->getPath();

	    if ($path != '/' && substr($path, -1) == '/') 
	    {
	        // permanently redirect paths with a trailing slash
	        // to their non-trailing counterpart
	        $uri = $uri->withPath(substr($path, 0, -1));
	        
	        if($req->getMethod() == 'GET')
	        {
	            return $res->withRedirect((string)$uri, 301);
	        }
	        else 
	        {
	            return $next($req->withUri($uri), $res);
	        }
	    }

	    return $next($req, $res);
	};
}