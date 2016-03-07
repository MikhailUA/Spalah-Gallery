<?php

require_once 'vendor/autoload.php';

require_once 'components/Router.php';
require_once 'components/UserSession.php';
require_once 'components/SocialLinks.php';

require_once 'controllers/BaseController.php';
require_once 'controllers/PaginationController.php';

require_once 'models/Picture.php';
require_once 'models/MySQLDB.php';


$mysqlConf = require_once 'mysql.php';
MySQLDB::init($mysqlConf['host'], $mysqlConf['dbName'], $mysqlConf['user'], $mysqlConf['password']);

$router = new Router($_SERVER['REQUEST_URI']);

if (!$router->handle()) {
    echo 'Path not found.';
}