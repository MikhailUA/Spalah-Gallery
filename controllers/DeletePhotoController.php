<?php

class DeletePhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        $username = UserSession::getInstance()->username;
        $photoId = $arguments[1];

        //$db = new FileDB();
        MySQLDB::getInstance()->deletePhoto($username,$photoId);
        Router::redirect('/');
        return true;
    }
}