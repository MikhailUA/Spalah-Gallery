<?php

require_once 'components/UserSession.php';
require_once 'models/FileDB.php';
require_once 'controllers/BaseController.php';
require_once 'components/Router.php';

$router = new Router($_SERVER['REQUEST_URI']);

if(!$router->handle()) {
    echo 'Path not found.';
}