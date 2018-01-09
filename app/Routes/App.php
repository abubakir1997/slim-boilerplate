<?php

/*
|--------------------------------------------------------------------------
| Application Routes for App
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$this->get(
	'',
	'Controllers\App\DashboardController:get'
)->setName('app.default');

/*
 * Dashboard
 */

$this->get(
	'/dashboard',
	'Controllers\App\DashboardController:get'
)->setName('dashboard');