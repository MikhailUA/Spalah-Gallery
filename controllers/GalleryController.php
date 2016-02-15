<?php

class GalleryController extends BaseController
{
    public function execute($arguments = [])
    {
        if(UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        $db = new FileDB();
        $photos = $db->getPhotos(UserSession::getInstance()->username, 1, 10) ?: [];
        $username = UserSession::getInstance()->username;


        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}