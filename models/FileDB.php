<?php

class FileDB {
    private $path;
    const USERS_FILE = 'usersFile.json';
    const PREFIX = 'photos_';
    public function __construct($path) {
        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $this->path = $path;
    }

    public function findUser($username, $password) {
        $f = fopen($this->path . DIRECTORY_SEPARATOR . FileDB::USERS_FILE, 'r');
        while(!feof($f)) {
            if($str = fgets($f)) {
                if($json = json_decode($str, true)) {
                    if($json['username'] == $username && $json['password'] == sha1($password)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function addUser($username, $password) {
        $f = fopen($this->path . DIRECTORY_SEPARATOR . self::USERS_FILE, 'a+');
        fwrite($f, json_encode([
                'id' => time(),
                'username' => $username,
                'password' => sha1($password),
            ]) . PHP_EOL);
        fclose($f);
    }

    public function addPhoto($username, $photoURI, $description) {
        $f = fopen($this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json', 'a+');
        fwrite($f, json_encode([
                'id' => time(),
                'username' => $username,
                'photoURI' => $photoURI,
                'description' => $description,
            ]) . PHP_EOL);
        fclose($f);
    }

    public function deletePhoto($username, $id) {
        $path = $this->path . DIRECTORY_SEPARATOR . self::PREFIX . $username . '.json';
        if(!file_exists($path)) {
            return false;
        }

        $f = fopen($path , 'r');
        $tFile = tempnam($this->path, 'temp');
        $t = fopen($tFile, 'a+');

        while(!feof($f)) {
            if($str = fgets($f)) {
                if($json = json_decode($str, true)) {
                    if($id != $json['id']) {
                        fwrite($t, $str . PHP_EOL);
                    }
                }
            }
        }

        fclose($t);
        fclose($f);

        rename($tFile, $path);
        return true;
    }
}
