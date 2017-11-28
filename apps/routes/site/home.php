<?php

use \Apps\Middlewares\Guest;

$this->get(
	'/',
	'SiteHomeController:get'
)->setName('home');

$this->get(
	'/home', 
	'SiteHomeController:get'
);