<?php

namespace spalahGallery\controllers;

use spalahGallery\models\MySQLDB;
use spalahGallery\components\UserSession;
use spalahGallery\components\Router;

class DeletePhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        $username = UserSession::getInstance()->username;
        $photoId = $arguments[1];

        MySQLDB::getInstance()->deletePhoto($username,$photoId);
        Router::redirect('/');
        return true;
    }
}