<?php

class IndexController extends BaseController {
    public function execute($arguments = []) {

        if(!UserSession::getInstance()->isGuest) {
            Router::redirect('/user/' . UserSession::getInstance()->username);
        }

        require_once 'views/parts/header.php';

        require_once 'views/main.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}