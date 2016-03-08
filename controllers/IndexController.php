<?php

namespace spalahGallery\controllers;

use spalahGallery\models\MySQLDB;
use spalahGallery\components\UserSession;
use spalahGallery\components\Router;

class IndexController extends BaseController
{
    public function execute($arguments = [])
    {

        if (!UserSession::getInstance()->isGuest) {
            Router::redirect('/user/' . UserSession::getInstance()->username . '/page/1');
        }

        if (
            isset($_POST['username']) &&
            isset($_POST['password']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {

            $userId = MySQLDB::getInstance()->findUser($_POST['username'], $_POST['password']);
            if ($userId) {
                UserSession::getInstance()->login($userId,$_POST['username']);
                Router::redirect('/user/' . UserSession::getInstance()->username . '/page/1');
            } else {
                $error = "Failed: Login and password not valid.";
            }
        } else if (
            isset($_POST['username']) &&
            isset($_POST['password'])
        ) {
            $error = "Failed: All fields are required.";
        }

        require_once 'views/parts/header.php';

        require_once 'views/main.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}