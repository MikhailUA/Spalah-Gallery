<?php

namespace spalahGallery\controllers;

use spalahGallery\components\UserSession;
use spalahGallery\components\Router;

class LogoutController extends BaseController
{
    public function execute($arguments = [])
    {
        if (!UserSession::getInstance()->isGuest) {
            UserSession::getInstance()->logout();
        }

        Router::redirect('/');
    }
}