<?php

namespace spalahGallery\models;
use DateTime;
use Imagick;

class Picture
{
    public static function uploadFile($tmpPath, $fileName, $username)
    {
        $pictureDir = __DIR__ . '/../pictures';
        $usernameDir = $pictureDir . '/' . $username;

        if (!file_exists($usernameDir)) {
            mkdir($usernameDir);
        }

        //$pahInfo = pathinfo($fileName);
        //$ext = isset($pahInfo['extension']) ? $pahInfo['extension'] : 'jpg';
        //$time = time();
        //$fileName = $time . '.' . $ext;
        $imageNewPath = $usernameDir . '/' . $fileName;
        move_uploaded_file($tmpPath, $imageNewPath);

        //self::thumbnailPhoto($imageNewPath);

        return $fileName;
    }

    public static function formatDate($dateStr)
    {
        $date = new DateTime($dateStr);
        return $date->format('d.m.Y H:i');

    }

    public static function thumbnailPhoto($photoPath){
        $img = new Imagick($photoPath);
        //$img ->thumbnailImage(512,512);
        //$img->cropThumbnailImage(512,512);
        // вариант с масштабированием
        $w = $img->getImageWidth();
        $h=$img->getImageHeight();
        $wNew=512;
        $hNew=$h*$wNew/$w;
        $img ->thumbnailImage($wNew,$hNew);
        $img ->writeImage($photoPath);
    }

}

