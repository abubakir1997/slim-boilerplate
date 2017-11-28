<?php

use \Libs\Config;

//Application
Config::set('app.debug', true);
Config::set('app.views', '/apps/views');
Config::set('app.logger','/logs/app.log');
Config::set('app.errors','/logs/error.log');
Config::set('app.salt',  '\xeb3I\xe5\xb1\x99TImn0\x1e`\xac\x0b\xee\x13\xc5c\x8dv\xbd\x87@');

//Default Database
Config::set('default.database', 'App');
Config::set('default.username', 'admin');
Config::set('default.password', 'admin');