<?php

class GalleryController extends BaseController
{
    public function execute($arguments = [])
    {
        if (UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        $userId = UserSession::getInstance()->userId;
        $photosCount = MySQLDB::getInstance()->getPhotosCount($userId);
        $perPage = 2;
        $page = $arguments[2]; // номер страницы для отображения
        $photos = MySQLDB::getInstance()->getPhotos($userId, $page, $perPage) ?: [];


        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}