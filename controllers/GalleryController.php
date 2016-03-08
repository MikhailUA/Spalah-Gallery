<?php
namespace spalahGallery\controllers;

use spalahGallery\components\SocialLinks;
use spalahGallery\models\MySQLDB;
use spalahGallery\models\Picture;
use spalahGallery\components\UserSession;
use spalahGallery\components\Router;

class GalleryController extends BaseController
{
    public function execute($arguments = [])
    {
        if (UserSession::getInstance()->isGuest) {
            Router::redirect('/');
        }

        $userId = UserSession::getInstance()->userId;
        $username = UserSession::getInstance()->username;
        $photosCount = MySQLDB::getInstance()->getPhotosCount($userId);
        $perPage = 2;
        $page = $arguments[2]; // номер страницы для отображения
        $photos = MySQLDB::getInstance()->getPhotos($userId, $page, $perPage) ?: [];

        foreach ($photos as $key => $photo) {

            $photos[$key]['SocialLinks'] = [
                'FB' => SocialLinks::getInstance($photo['username'], $photo['photoURI'], $photo['description'])->Fb(),
                'LN' => SocialLinks::getInstance($photo['username'], $photo['photoURI'], $photo['description'])->LN(),
                'VK' => SocialLinks::getInstance($photo['username'], $photo['photoURI'], $photo['description'])->VK()
            ];
            $photo['date'] = Picture::formatDate($photo['date']);
        }
        //var_dump($photos);die;


        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}