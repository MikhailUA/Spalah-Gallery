<?php

class GalleryController extends BaseController
{
    public function execute($arguments = [])
    {
        if (UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        $db = new FileDB();

        $username = UserSession::getInstance()->username;

        $photosCount = $db->getPhotosCount($username);
        $perPage = 2;
        $page = $arguments[2]; // номер страницы для отображения

        $photos = $db->getPhotos($username, $page, $perPage) ?: [];

        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}