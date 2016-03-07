<?php


Class SocialLinks {

    public $page=null;
    private static $instance;

    public function __construct($url,$title,$text,$image,$twitterUser)
    {
        $this->page = new \SocialLinks\Page([
            'url' => $url,
            'title' => $title,
            'text' => $text,
            'image' => $image,
            'twitterUser' => $twitterUser
        ]);
    }

    /*public static function init ($url,$title,$text,$image,$twitterUser){
        if (!self::$instance){
            self::$instance = new self($url,$title,$text,$image,$twitterUser);
        }
    }

    public static function getInstance(){
        if (self::$instance){
            return self::$instance;
        } else {
            throw new Exception('No instance');
        }
    }*/
}

