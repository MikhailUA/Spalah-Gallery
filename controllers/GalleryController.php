<?php

class GalleryController extends BaseController {
    public function execute($arguments = []) {
        require_once 'views/parts/header.php';

        require_once 'views/gallery.php';

        require_once 'views/parts/footer.php';


        return true;
    }
}