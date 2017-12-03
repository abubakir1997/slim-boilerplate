<?php

$this->get(
	'/',
	'SiteHomeController:get'
)->setName('home');

$this->get(
	'/home', 
	'SiteHomeController:get'
);