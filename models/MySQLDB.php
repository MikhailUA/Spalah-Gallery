<?php

class MySQLDB
{

    public $db=null;
    public $host = 'mysql:dbname=spalah-gallery;host=127.0.0.1';
    public $user = 'root';
    public $password = '';

    public function __construct()
    {
        try {
        $this->db= new PDO('mysql:dbname=spalah-gallery;host=127.0.0.1','root');
        } catch (PDOException $e){
            echo "Connection Failed". $e->getMessage();
        }
    }

    public function findUser($username, $password)
    {

    }

    public function findUsername($username)
    {

    }

    public function addUser($username, $password)
    {
        $pdo = $this->db;
        $statement = $pdo->prepare("INSERT INTO users (username,password) VALUES (:username,:password)");
        $statement->bindValue('username',$username);
        $statement->bindValue('password',sha1($password));

        $statement->execute();
        var_dump($statement->errorInfo());
        $er=$statement->errorInfo();
        echo $er;
    }

    public function addPhoto($username, $photoURI, $description)
    {

    }

    public function getPhoto($username, $photoId)
    {

    }

    public function getPhotos($username, $page, $perPage)
    {

    }

    public function deletePhoto($username, $id)
    {

    }

    public function getPhotosCount($username)
    {

    }

    public function pagination($photosCount, $perPage)
    {

    }
}
