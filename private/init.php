<?php

//Classes
use \Libs\App;
use \Libs\Container;
use \Middlewares\Auth;

//Initiate App Container
$container = new Container();

//App Settings
$container->settings();

//Creating Logs
$container->logger();

//Create View
$container->view();
$container->errors();

//Create Authentication
$container->authentication();

//Create Controllers
$container->controllers();

//Initiate App
$app = new App($container);

//Import Routes
$siteGroup = $app->routes($container, /*$folder =*/ 'site');
$appGroup  = $app->routes($container, /*$folder =*/ 'app', /*$prefix =*/ '/app');

//Middlewares
$appGroup->add(new Auth($container))->add($container->get('csrf'));