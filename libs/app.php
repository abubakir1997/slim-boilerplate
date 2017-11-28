<?php

namespace Libs;

use \Apps\Middlewares\Auth;

use \Slim\App as SlimApp;
use \Slim\Container as SlimContainer;

class App extends SlimApp
{
	private $routes = [];

	/**
	 * Application Routes
	 * Adds Route Files
	 * @return void
	 * @author Abdelrahman Salem
	 *
	 * @var folder to import
	 * @var prefix to assign
	 * @var guard add csrf protection
	 **/
	public function routes(SlimContainer $container, string $folder, string $prefix = '', bool $auth = false)
	{
		$container->groups[$folder] = $prefix;
		$group = $this->group($prefix, function () use(&$folder, &$container) {
			foreach (glob(ROOT."/apps/routes/$folder/*.php") as $route)
			{
				require_once $route;
			}
		});

		if ($auth)
		{
			$group->add(new Auth($container));
		}

		return $group;
	}
}