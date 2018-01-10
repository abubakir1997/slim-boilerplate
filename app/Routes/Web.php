<?php

/*
|--------------------------------------------------------------------------
| Application Routes for Web
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$this->get(
	'/',
	'Controllers\Web\HomeController:get'
)->setName('home');

$this->get(
	'/home', 
	'Controllers\Web\HomeController:get'
);

/*
 * Signin Routes
 */

$this->post(
	'/signin',
	'Controllers\Web\SignController:post'
)->setName('signin.post');

$this->get(
	'/signout',
	'Controllers\Web\SignController:destroy'
)->setName('signout');

$signin = $this->group('', function() {
	$this->get(
		'/signin',
		'Controllers\Web\SignController:get'
	)->setName('signin');

	$this->get(
		'/login',
		'Controllers\Web\SignController:get'
	);
});

$signin
	->add($container->get('guest'))
	->add($container->get('csrf'))
;