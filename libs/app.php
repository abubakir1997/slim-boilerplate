<?php

namespace Libs;

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
	 **/
	public function routes(SlimContainer $container, string $folder, string $prefix = '')
	{
		$container->groups[$folder] = $prefix;
		$group = $this->group($prefix, function () use(&$folder, &$container) {
			foreach (glob(ROOT."/private/routes/$folder/*.php") as $route)
			{
				require_once $route;
			}
		});

		return $group;
	}
}