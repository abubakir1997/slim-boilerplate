<?php

$this->get(
	'', 
	'AppDashboardController:get'
)->setName('dashboard');

$this->get(
	'/dashboard', 
	'AppDashboardController:get'
);

$this->post('/test', function($req, $res) {
	return $res->withJson(['status' => 'Success!']);
});