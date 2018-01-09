<?php

/*
|--------------------------------------------------------------------------
| Global Variables
|--------------------------------------------------------------------------
|
| Define Global Variables to be used trough out the entire application.
|
*/

define('ROOT', realpath(__DIR__ . '/../'));
defined('APP_ENV') || define('APP_ENV', (getenv('APP_ENV') ? strtolower(getenv('APP_ENV')) : 'dev'));

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
|
| Set Application Time Zone.
|
*/

date_default_timezone_set('America/New_York');

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
|
| Set error reporting to true so 
| that it could be handled by Slim Framrework
|
*/

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', ROOT.'/logs/error.log');

error_reporting(E_ALL);

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

require_once ROOT.'/vendor/autoload.php';
require_once ROOT.'/configs/'.APP_ENV.'.php';
require_once ROOT.'/bootstrap/run.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();