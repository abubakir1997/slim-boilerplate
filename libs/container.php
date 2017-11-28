<?php

namespace Libs;

use \Core\Controller;
use \Libs\Twig as TwigExtension;

use \Apps\Middlewares\Csrf;

use \Monolog\Logger as MonologLogger;
use \Monolog\Handler\StreamHandler as MonologStream;
use \Monolog\Handler\FingersCrossedHandler as MonologFingersCrossed;

use \Slim\Views\Twig as SlimTwig;
use \Slim\Container as SlimContainer;
use \Slim\Flash\Messages as SlimMessages;
use \Slim\Views\TwigExtension as SlimTwigExtension;
use \Knlv\Slim\Views\TwigMessages as SlimTwigMessages;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Container extends SlimContainer
{
	public $groups = [];
	public $jwt;

	/**
	 * Application Main Groups
	 * Gets Group Path
	 * @return string
	 * @author Abdelrahman Salem
	 **/
	public function groupPath($key)
	{
		return $this->groups[$key];
	}

	/**
	 * Application Settings
	 * Modifies Settings Array
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function settings()
	{
		$this['settings']['displayErrorDetails'] = Config::get('app.debug', false);
	}

	/**
	 * Application View
	 * Modifies Twig Class
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function view()
	{
		Session::init();
		
		$this['flash'] = new SlimMessages;
		$this['view']  = function(SlimContainer $c) : SlimTwig
		{
			$views = Config::get('app.views');
			$cache = Config::get('app.cache', false);

			//Initiate View Method
			$view  = new SlimTwig(ROOT.$views, [
				'cache' => $cache == false ? $cache : ROOT.$cache
			]);

			//Add Extensions
			$view->addExtension(new TwigExtension($c->router, $c->request->getUri()));
			$view->addExtension(new SlimTwigMessages($c->flash));
			
			$view->getEnvironment()->addGlobal('csrf', [
				'nameKey'	=> $this->csrf->getTokenNameKey(),
	    		'valueKey'	=> $this->csrf->getTokenValueKey(),
	    		'name'		=> $this->csrf->getTokenName(),
	    		'value'		=> $this->csrf->getTokenValue()
			]);

			return $view;
		};
	}

	/**
	 * Application Authentications
	 * Modifies Twig Class
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function authentication()
	{
		$this['csrf']  = function(SlimContainer $c) : Csrf
		{
			$guard = new Csrf;
			$guard->setFlash($c->flash);

			return $guard;
		};
	}

	/**
	 * Error Handler
	 * Modifies Error Handler
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function errors()
	{
		$this['notFoundHandler'] = function (SlimContainer $c)
		{
			return function (Request $req, Response $res) use ($c) : Response
			{
				return $c->view->render($res->withStatus(404), 'error.twig', [
					'code' => 404,
					'route' => $req->getUri()
				]);
			};
		};

		$this['notAllowedHandler'] = function (SlimContainer $c)
		{
			return function (Request $req, Response $res) use ($c) : Response
			{
				return $c->view->render($res->withStatus(403), 'error.twig', [
					'code' => 403,
					'route' => $req->getUri()
				]);
			};
		};
	}

	/**
	 * Application Logger
	 * Modifies Monolog Class
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function logger()
	{
		$this['logger'] = function(SlimContainer $c) : MonologLogger
		{
			$logs = Config::get('app.logger', '/logs/app.log');

			$logger  = new MonologLogger('logger');
		    $stream  = new MonologStream(ROOT.$logs, MonologLogger::DEBUG);
		    $fgCross = new MonologFingersCrossed($stream, MonologLogger::ERROR);
		    
		    $logger->pushHandler($fgCross);
		 
		    return $logger;
		};
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function controllers()
	{
		foreach (glob(ROOT."/apps/controllers/**/*.php") as $controller)
		{
			$file  = ucfirst(substr(basename($controller), 0, -4));
			$foldr = ucfirst(basename(dirname($controller)));

			$prop  = "{$foldr}{$file}Controller";
			$class = "\Apps\Controllers\\{$foldr}\\{$file}";

			$this[$prop] = function(SlimContainer $c) use($class) : Controller
			{
				return new $class($c->view, $c->router, $c->flash, $c->logger);
			};
		}
	}
}