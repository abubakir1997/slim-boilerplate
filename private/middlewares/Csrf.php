<?php

namespace Middlewares;

use \Slim\Csrf\Guard as SlimGuard;
use \Slim\Flash\Messages as SlimMessages;
use \Psr\Http\Message\RequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Csrf extends SlimGuard
{
    private $flash;
    
    public function setFlash(SlimMessages $flash)
    {
        $this->flash = $flash;
    }

	public function getFailureCallable()
    {
        if (is_null($this->failureCallable)) 
        {
            $this->failureCallable = function (Request $req, Response $res, callable $next) : Response
            {
                $msg = 'Failed CSRF Request!';

                if ($req->isXhr())
                {
                    $name  = $req->getHeaderLine('X-CSRFKey');
                    $value = $req->getHeaderLine('X-CSRFToken');
                    $valid = $this->validateToken($name, $value);

                    return $valid ? $next($req, $res) : $res->withJson(['error' => $msg], 400);
                }

                $this->flash->addMessage('csrf', $msg);
                return $res->withRedirect($req->getUri());
            };
        }

        return $this->failureCallable;
    }
}