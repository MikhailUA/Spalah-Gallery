<?php

Class SocialLinks {

    public static function constr ($username,$photoURI,$text)
    {
        $image = 'https://spalah-gallery.local/' . 'pictures/' . $username . '/' . $photoURI;
        $page = new \SocialLinks\Page([
            'url' => $image,
            'title' => "Spalah-Gallery",
            'text' => $text,
            'image' => $image,
            'twitterUser' => ''
        ]);
        return $page;
    }

        public static function sFbN ($page){
        $link = '<a href="%s">%s (%s)</a> ';
        return printf($link, $page->facebook->shareUrl, 'FB', $page->facebook->shareCount);
    }

        public static function sLNN ($page){
        $link = '<a href="%s">%s (%s)</a> ';
        return printf($link, $page->linkedin->shareUrl, 'LN', $page->linkedin->shareCount);
    }

        public static function sVKN ($page){
        $link = '<a href="%s">%s (x)</a> ';
        return printf($link, $page->Vk->shareUrl, 'VK', $page->Vk->shareCount);
    }

}


/*
function sFb ($username,$photoURI,$text){
    $image='https://spalah-gallery.local/'.'pictures/'.$username.'/'.$photoURI;
    $page = new \SocialLinks\Page([
        'url' => $image,
        'title' => "Spalah-Gallery",
        'text' => $text,
        'image' => $image,
        'twitterUser' => ''
    ]);

    $link = '<a href="%s">%s (%s)</a> ';
    return printf($link, $page->facebook->shareUrl, 'FB', $page->facebook->shareCount);
}

function sLN ($username,$photoURI,$text){
    $image='https://spalah-gallery.local/'.'pictures/'.$username.'/'.$photoURI;
    $page = new \SocialLinks\Page([
        'url' => $image,
        'title' => "Spalah-Gallery",
        'text' => $text,
        'image' => $image,
        'twitterUser' => ''
    ]);

    $link = '<a href="%s">%s (%s)</a> ';
    return printf($link, $page->linkedin->shareUrl, 'LinkedIn', $page->linkedin->shareCount);
}

function sVK ($username,$photoURI,$text){
    $image='https://spalah-gallery.local/'.'pictures/'.$username.'/'.$photoURI;
    $page = new \SocialLinks\Page([
        'url' => $image,
        'title' => "Spalah-Gallery",
        'text' => $text,
        'image' => $image,
        'twitterUser' => ''
    ]);

    $link = '<a href="%s">%s (x)</a> ';
    return printf($link, $page->Vk->shareUrl, 'VK');
}*/