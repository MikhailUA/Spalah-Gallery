<?php

namespace spalahGallery\components;

Class SocialLinks
{

    private $page;
    private static $instance;

    public function __construct($username, $photoURI, $text)
    {
        $image = 'spalah-gallery.local/' . 'pictures/' . $username . '/' . $photoURI;
        $this->page = new \SocialLinks\Page([
            'url' => $image,
            'title' => "Spalah-Gallery",
            'text' => $text,
            'image' => $image,
            'twitterUser' => ''
        ]);
    }

    public static function getInstance($username, $photoURI, $text)
    {
        return self::$instance = new self($username, $photoURI, $text);
    }

    public function Fb()
    {
        return '<a href="' . $this->page->facebook->shareUrl . '">FB (' . $this->page->facebook->shareCount . ')</a> ';
    }

    public function LN()
    {
        return '<a href="' . $this->page->linkedin->shareUrl . '">LN (' . $this->page->linkedin->shareCount . ')</a> ';
    }

    public function VK()
    {
        return '<a href="' . $this->page->Vk->shareUrl . '">VK</a> ';
    }
}