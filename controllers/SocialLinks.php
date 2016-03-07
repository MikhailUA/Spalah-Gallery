<?php

function soc ($url,$title,$text,$image,$twitterUser){
    $page = new \SocialLinks\Page([
        'url' => $url,
        'title' => $title,
        'text' => $text,
        'image' => $image,
        'twitterUser' => $twitterUser
    ]);

    $link = '<a href="%s">%s (%s)</a>';
    return [
        printf($link, $page->facebook->shareUrl, 'FB', $page->facebook->shareCount),
        printf($link, $page->linkedin->shareUrl, 'LinkedIn', $page->linkedin->shareCount)
    ];

}

