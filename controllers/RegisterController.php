<?php

class RegisterController extends BaseController {
    public function execute($arguments = []) {
        require_once 'views/parts/header.php';

        require_once 'views/register.php';

        require_once 'views/parts/footer.php';

        return true;
    }
}