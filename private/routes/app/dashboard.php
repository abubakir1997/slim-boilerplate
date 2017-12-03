<?php

$this->get(
	'', 
	'AppDashboardController:get'
)->setName('dashboard');

$this->get(
	'/dashboard', 
	'AppDashboardController:get'
);