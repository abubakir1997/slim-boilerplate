<?php

$this->get(
	'', 
	'AppDashboardController:get'
)->setName('dashboard');

$this->get(
	'/dashboard', 
	'AppDashboardController:get'
);

$this->post('/jwt', function($req, $res) {
	return $res->withJson($this->jwt);
});