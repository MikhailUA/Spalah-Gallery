<?php

/**
 //* @property MySQLDB
 //* Class MySQLDB
 */
//namespace gallery;

class MySQLDB
{

    private static $instance;
    private $db=null;
    
    public static function init ($host, $dbName,$user, $password){
        if (!self::$instance){
        self::$instance = new self ($host, $dbName, $user, $password);
        }
    }

    public static function getInstance(){
        if (self::$instance){
            return self::$instance;
        } else {
            throw new Exception('No instance');
        }
    }

    public function __construct($host,$dbName,$user,$password)
    {
        try {
            $this->db= new PDO("mysql:host=$host;dbname=$dbName;charset=UTF8",$user,$password);
        } catch (PDOException $e){
            echo "Connection Failed". $e->getMessage();
            die;
        }
    }

    public function findUser($username, $password)
    {

    }

    public function findUsername($username)
    {
        $statement = $this->db->prepare("SELECT * FROM users WHERE username=:username");
        $statement->bindValue('username',$username);

        if ($statement->execute()){
            if ($statement->fetch()){
                return true;
            }
        }else{
            throw new Exception();
        }
        return false;
    }

    public function addUser($username, $password)
    {
        $statement = $this->db->prepare("INSERT INTO users (username,password,regDate) VALUES (:username,:password,NOW())");
        $statement->bindValue('username',$username);
        $statement->bindValue('password',sha1($password));

        if(!$statement->execute()) {
            echo $statement->errorInfo();
        } else {
            return $this->db->lastInsertId();
        }
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
