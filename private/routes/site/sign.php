<?php

use \Middlewares\Guest;

$this->group('', function() {
	$this->get(
		'/signin',
		'SiteSignController:get'
	)->setName('signin');

	$this->get(
		'/login',
		'SiteSignController:get'
	);
})->add(new Guest($container))->add($container->get('csrf'));

$this->post(
	'/signin',
	'SiteSignController:post'
)->setName('signin.post');

$this->get(
	'/signout',
	'SiteSignController:destroy'
)->setName('signout');