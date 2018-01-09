<?php

use \Libs\Config;

/*
|--------------------------------------------------------------------------
| Application Configs
|--------------------------------------------------------------------------
*/

Config::set('app.debug', true);
Config::set('app.views', '/resources/views');
Config::set('app.logger','/logs/app.log');
Config::set('app.errors','/logs/error.log');
Config::set('app.salt',  'YOUR_CUSTOM_SALT_CHOOSE_WISELY');
Config::set('app.secret','KEEP_THIS_VERY_VERY_VERY_SECURE');

/*
|--------------------------------------------------------------------------
| Default Database
|--------------------------------------------------------------------------
*/

Config::set('default.database', 'APP');
Config::set('default.username', 'root');
Config::set('default.password', 'root');