<?php

class PhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        $photoId = $arguments[2];
        $db = new FileDB();
        $username = UserSession::getInstance()->username;
        $photo = $db->getPhoto($username, $photoId);

        require_once 'views/parts/header.php';

        require_once 'views/photo.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}