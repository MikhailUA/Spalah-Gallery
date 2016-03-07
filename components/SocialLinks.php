<?php

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
        $link = '<a href="%s">%s (%s)</a> ';
        return printf($link, $this->page->facebook->shareUrl, 'FB', $this->page->facebook->shareCount);
    }

    public function LN()
    {
        $link = '<a href="%s">%s (%s)</a> ';
        return printf($link, $this->page->linkedin->shareUrl, 'LN', $this->page->linkedin->shareCount);
    }

    public function VK()
    {
        $link = '<a href="%s">%s</a> ';
        return printf($link, $this->page->Vk->shareUrl, 'VK');
    }
}