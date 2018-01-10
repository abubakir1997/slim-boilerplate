<?php

namespace Libs;

use \Middlewares\Csrf;
use \Middlewares\Auth;
use \Middlewares\Guest;

use \Controllers\Web\ErrorController;

use \Monolog\Logger as MonologLogger;
use \Monolog\Handler\StreamHandler as MonologStream;
use \Monolog\Handler\FingersCrossedHandler as MonologFingersCrossed;

use \Slim\Views\Twig as SlimTwig;
use \Slim\Container as SlimContainer;
use \Slim\Flash\Messages as SlimFlash;
use \Slim\Views\TwigExtension as SlimTwigExtension;
use \Knlv\Slim\Views\TwigMessages as SlimTwigMessages;

use \Illuminate\Database\Capsule\Manager as Capsule;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Container extends SlimContainer
{
	public $jwt;

	/**
	 * Application Settings
	 * Modifies Settings Array
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	function __construct()
	{
		$values = [
			'settings' => [
				'displayErrorDetails' => Config::get('app.debug', false)
			]
		];

		parent::__construct($values);
	}

	/**
	 * Bind Application View
	 * Modifies Twig Class
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindView()
	{
		$this['view'] = function(SlimContainer $c) : SlimTwig
		{
			$views = Config::get('app.views');
			$cache = Config::get('app.cache', false);

			// Initiate View Method
			$view = new SlimTwig(ROOT.$views, [
				'cache' => $cache == false ? $cache : ROOT.$cache
			]);

			// Add Extensions
			$view->addExtension(new Twig($c->router, $c->request->getUri()));
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
	 * Bind Flash Messages
	 * Returns Flash Message to Twig
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindFlash()
	{
		Session::init();

		$this['flash'] = new SlimFlash;
	}

	/**
	 * Bind Application Authentications
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindCsrf()
	{
		$this['csrf'] = function(SlimContainer $c) : Csrf
		{
			$guard = new Csrf;
			$guard->setFlash($c->flash);

			return $guard;
		};
	}

	/**
	 * Bind Application Auth
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindAuth()
	{
		$this['auth'] = function(SlimContainer $c) : Auth
		{
			return new Auth($c);
		};
	}

	/**
	 * Bind Application Auth
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindGuest()
	{
		$this['guest'] = function(SlimContainer $c) : Guest
		{
			return new Guest($c);
		};
	}

	/**
	 * Bind Application Logger
	 * Modifies Monolog Class
	 * @return void
	 * @author Abdelrahman Salem
	 **/
	public function bindLogger()
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
	 * Bind Eloquent ORM
	 * A PDO ORM
	 * @return void
	 * @author Abdelrahman Salem 
	 **/
	function bindEloquent($driver = 'default')
	{
		$capsule = new Capsule;
		
		$capsule->addConnection([
		    'driver'    => Config::get("$driver.driver", 'mysql'),
		    'host'      => Config::get("$driver.host", '127.0.0.1'),
		    'database'  => Config::get("$driver.database"),
		    'username'  => Config::get("$driver.username", ''),
		    'password'  => Config::get("$driver.password", ''),
		    'charset'   => Config::get("$driver.charset", 'utf8'),
		    'collation' => Config::get("$driver.collation", 'utf8_unicode_ci'),
		    'prefix'    => Config::get("$driver.prefix", ''),
		]);

		$capsule->bootEloquent();
	}

	/**
	 * Bind Error Handlers
	 * @return ErrorController:method
	 * @author Abdelrahman Salem
	 **/
	public function bindErrorHandlers()
	{
		$error = new ErrorController($this);

		$this['notFoundHandler'] = function () use ($error)
		{
		    return function($req, $res) use ($error)
		    {
		    	return $error->notFound($req, $res);
		    };
		};

		$this['notAllowedHandler'] = function () use ($error)
		{
		    return function($req, $res) use ($error)
		    {
		    	return $error->notAllowed($req, $res);
		    };
		};

		$this['phpErrorHandler'] = function () use ($error)
		{
		    return function($req, $res) use ($error)
		    {
		    	return $error->phpError($req, $res);
		    };
		};

		$this['errorHandler'] = function () use ($error)
		{
		    return function($req, $res) use ($error)
		    {
		    	return $error->errorHandler($req, $res);
		    };
		};
	}
}