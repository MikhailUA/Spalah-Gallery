<?php

class RegisterController extends BaseController {
    public function execute($arguments = []) {

        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password-confirm'])) {
            if($_POST['password'] == $_POST['password-confirm']) {
                $fdb = new FileDB(__DIR__ . '/../db');
                if (!$fdb->findUser($_POST['username'],$_POST['password'])){
                    $fdb->addUser($_POST['username'], $_POST['password']);
                    UserSession::getInstance()->login($_POST['username']);
                    Router::redirect('/');
                }else{
                    $error = "Failed: User Exists Already";
                }
            }
        }

        require_once 'views/parts/header.php';

        require_once 'views/register.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}