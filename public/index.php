<?php

define('ROOT', realpath(__DIR__ . '/../'));
defined('APP_ENV') || define('APP_ENV', (getenv('APP_ENV') ? strtolower(getenv('APP_ENV')) : 'dev'));
date_default_timezone_set('America/New_York');

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', ROOT.'/logs/error.log');
error_reporting(E_ALL);

require_once ROOT.'/vendor/autoload.php';
require_once ROOT.'/configs/'.APP_ENV.'.php';
require_once ROOT.'/apps/init.php';

$app->run();