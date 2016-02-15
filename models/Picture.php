<?php

class Picture {
    public static function uploadFile($tmpPath, $fileName, $username) {
        $pictureDir = __DIR__ . '/../pictures';
        $usernameDir = $pictureDir . '/' . $username;

        if(!file_exists($usernameDir)) {
            mkdir($usernameDir);
        }

        $pahInfo = pathinfo($fileName);
        $ext = isset($pahInfo['extension']) ? $pahInfo['extension'] : 'jpg';
        $time = time();
        $fileName = $time . '.' . $ext;
        $imageNewPath = $usernameDir . '/' . $fileName;
        move_uploaded_file($tmpPath, $imageNewPath);

        return $fileName;
    }
}