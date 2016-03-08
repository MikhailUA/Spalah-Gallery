<?php

/**
 * //* @property MySQLDB
 * //* Class MySQLDB
 */
//namespace gallery;

class MySQLDB
{

    private static $instance;
    private $db = null;

    public static function init($host, $dbName, $user, $password)
    {
        if (!self::$instance) {
            self::$instance = new self ($host, $dbName, $user, $password);
        }
    }

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        } else {
            throw new Exception('No instance');
        }
    }

    public function __construct($host, $dbName, $user, $password)
    {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbName;charset=UTF8", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            echo "Connection Failed" . $e->getMessage();
            die;
        }
    }

    public function findUser($username, $password)
    {
        $statement = $this->db->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
        $statement->bindValue('username', $username);
        $statement->bindValue('password', sha1($password));
        if ($statement->execute()) {
            $data = $statement->fetch();
            if ($data) {
                $userId = $data['id'];
                return $userId;
            }
        }
    }

    public function findUsername($username)
    {
        $statement = $this->db->prepare("SELECT * FROM user WHERE username=:username");
        $statement->bindValue('username', $username);

        if ($statement->execute()) {
            if ($statement->fetch()) {
                return true;
            }
        } else {
            throw new Exception();
        }
        return false;
    }

    public function addUser($username, $password)
    {
        $statement = $this->db->prepare("INSERT INTO user (username,password,regDate) VALUES (:username,:password,NOW())");
        $statement->bindValue('username', $username);
        $statement->bindValue('password', sha1($password));
        if (!$statement->execute()) {
            echo $statement->errorInfo();
        } else {
            return $this->db->lastInsertId();
        }
    }

    public function addPhoto($userId, $photoURI, $description)
    {
        $statement = $this->db->prepare("INSERT INTO photo (userId,photoURI,description,date) VALUES (:userId,:photoURI,:description,NOW())");
        $statement->bindValue('userId', $userId);
        $statement->bindValue('photoURI', $photoURI);
        $statement->bindValue('description', $description);

        if (!$statement->execute()) {
            echo var_dump($statement->errorInfo());
            die;
        } else {
            return $this->db->lastInsertId();
        }
    }

    public function getPhoto($photoId)
    {
        $statement = $this->db->prepare("
             SELECT photoURI,description,date,name,text,createdAt FROM photo
             LEFT JOIN comment ON comment.photoId=photo.photoId
             WHERE photo.photoId=:photoId");
/*        $statement = $this->db->prepare("
             SELECT photoURI,description,date FROM photo
             WHERE photo.photoId=:photoId");*/
        $statement->bindValue('photoId', $photoId);

        if ($statement->execute()) {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($data);die;
            if ($data) {
                $photosToDisplay['photo'] = $data[0];
                $photosToDisplay['comments'] = $data;

                return [
                    'photoId' => $photoId,
                    'photoURI' => $photosToDisplay['photo']['photoURI'],
                    'description' => $photosToDisplay['photo']['description'],
                    'comments' => $photosToDisplay['comments']
                ];
            } else {
                echo var_dump($statement->errorInfo());
                die;
            }
        } else {
            echo var_dump($statement->errorInfo());
            die;
        }

    }


    public function getPhotos($userId, $page, $perPage)
    {
        $start = $page * $perPage - $perPage;

        $statement = $this->db->prepare("
                      SELECT id,username,photoId,photoURI,description,date FROM photo
                      INNER JOIN user ON photo.userId=id WHERE userId=:userId
                      LIMIT :start,:perPage");

        $statement->bindValue('userId', $userId);
        $statement->bindValue('start', $start, PDO::PARAM_INT);
        $statement->bindValue('perPage', $perPage, PDO::PARAM_INT);

        if ($statement->execute()) {
            $photosToDisplay = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $photosToDisplay;
        } else {
            echo var_dump($statement->errorInfo());
            die;
        }
    }

    public function deletePhoto($username, $photoId)
    {
        //удаление из базы
        $statement = $this->db->prepare("
            SELECT photoURI FROM photo WHERE photoId=:photoId;
            DELETE FROM photo WHERE photoId=:photoId;");
        $statement->bindValue('photoId', $photoId);
        if ($statement->execute()) {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
            $filename = $data['photoURI'];
        } else {
            echo var_dump($statement->errorInfo());
            die;
        }

        // удаление с диска
        $filePath = "./pictures/" . $username . "/" . $filename;
        unlink($filePath);

        return true;
    }

    public function getPhotosCount($userId)
    {
        $statement = $this->db->prepare("SELECT COUNT(*) FROM photo WHERE userId=:userId");
        $statement->bindValue('userId', $userId);
        if ($statement->execute()) {
            return $photoCount = $statement->fetchColumn();
        }
    }


    public function addComment ($photoId,$name,$text){
        $statement = $this->db->prepare("INSERT INTO comment (photoId,name,text,createdAt) VALUES (:photoId,:name,:text,NOW())");
        $statement->bindValue('photoId',$photoId);
        $statement->bindValue('name',$name);
        $statement->bindValue('text',$text);
        if ($statement->execute()){
            return $this->db->lastInsertId();
        }else{
            echo var_dump($statement->errorInfo());
            die;
        }
    }
}
