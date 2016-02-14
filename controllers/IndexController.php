<?php

class IndexController extends BaseController {
    public function execute($arguments = []) {
        if ($_SERVER['REQUEST_URI']=='/logout'){
            UserSession::getInstance()->logout();
            Router::redirect('/');
        }

        if(!UserSession::getInstance()->isGuest) {
            Router::redirect('/user/' . UserSession::getInstance()->username);
        }

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $fdb = new FileDB(__DIR__ . '/../db');
            if ($fdb->findUser($_POST['username'], $_POST['password'])) {
                UserSession::getInstance()->login($_POST['username']);
                Router::redirect('/user/' . UserSession::getInstance()->username);
            }else{
                $error = "Failed";
            }

        }

        require_once 'views/parts/header.php';

        require_once 'views/main.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}