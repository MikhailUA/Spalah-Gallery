<?php

namespace spalahGallery\controllers;

use spalahGallery\models\MySQLDB;
use spalahGallery\components\UserSession;


class PhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        $photoId = $arguments[2];
        $username = UserSession::getInstance()->username;

        if (!empty($_POST)){
            if (isset($_POST['name']) && isset($_POST['text'])){
                MySQLDB::getInstance()->addComment($photoId,$_POST['name'],$_POST['text']);
            }
        }

        $photo = MySQLDB::getInstance()->getPhoto($photoId);

        require_once 'views/parts/header.php';

        require_once 'views/photo.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}