<?php

class DeletePhotoController extends BaseController
{
    public function execute($arguments = [])
    {

        $username = UserSession::getInstance()->username;
        $id = $_SESSION['photoId'];

        $db = new FileDB();
        $db->deletePhoto($username, $id);
        Router::redirect('/');
        return true;
    }
}