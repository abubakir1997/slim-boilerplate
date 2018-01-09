<?php

use \Libs\Config;

/*
|--------------------------------------------------------------------------
| Application Configs
|--------------------------------------------------------------------------
*/

Config::set('app.cache', '/cache/views');
Config::set('app.salt',  'YOUR_CUSTOM_SALT_CHOOSE_WISELY');
Config::set('app.secret','KEEP_THIS_VERY_VERY_VERY_SECURE');