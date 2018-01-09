<?php

use \Slim\App;
use \Libs\Container;

/*
|--------------------------------------------------------------------------
| Create Application Container
|--------------------------------------------------------------------------
|
| Create application core functionalities along with configurations.
| 
*/

$container = new Container();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$container->bindLogger();
$container->bindView();
$container->bindCsrf();
$container->bindAuth();
$container->bindGuest();
$container->bindEloquent();

$container->routeErrors();

/*
|--------------------------------------------------------------------------
| Create Application Instance
|--------------------------------------------------------------------------
| 
| Here we will create the application object and load the container
| within the objec.
|
*/

$app = new App($container);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$webGroup = $app->group('', function () use ($container) {
	require_once ROOT.'/app/Routes/Web.php';
});

$appGroup = $app->group('/app', function () {
	require_once ROOT.'/app/Routes/App.php';
});

/*
|--------------------------------------------------------------------------
| Register Middlewares
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$appGroup
	->add($container->get('auth'))
	->add($container->get('csrf'))
;

/*
 | EOF
 */