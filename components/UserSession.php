<?php

namespace spalahGallery\components;

/**
 * Class UserSession
 * @property bool isGuest
 * @property string username
 * @property int userId
 */
class UserSession
{

    private $isGuest = true;
    private $userId = null;
    private $username = null;
    private static $instance;

    private function __construct()
    {
        session_start();
        $this->isGuest = isset($_SESSION['isGuest']) ? $_SESSION['isGuest'] : true;
        $this->userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __get($name)
    {
        if ($name == 'isGuest') {
            return $this->isGuest;
        } else if ($name == 'username') {
            return $this->username;
        } else if ($name == 'userId') {
            return $this->userId;
        }
    }

    public function login($userId, $username)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->isGuest = false;

        $_SESSION['isGuest'] = $this->isGuest;
        $_SESSION['userId'] = $this->userId;
        $_SESSION['username'] = $this->username;

    }

    public function logout()
    {
        $this->userId = null;
        $this->username = null;
        $this->isGuest = true;

        unset($_SESSION['isGuest']);
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        session_destroy();
    }

}