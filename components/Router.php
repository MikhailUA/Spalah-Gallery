<?php

namespace spalahGallery\components;

class Router
{

    private $uri;
    private $routes = [
        '/^\/$/' => 'IndexController',
        '/^\/index$/' => 'IndexController',
        '/^\/user\/([A-Za-z0-9]+)\/page\/(\d+)$/' => 'GalleryController',
        '/^\/signup$/' => 'RegisterController',
        '/^\/photo$/' => 'AddPhotoController',
        '/^\/user\/([A-Za-z0-9]+)\/photo\/(.+)/' => 'PhotoController',
        '/^\/deletePhoto$/' => 'DeletePhotoController'
    ];

    public function __construct($requestUri)
    {
        $this->uri = $requestUri;
    }

    public function handle()
    {
        foreach ($this->routes as $key => $value) {
            $matches = [];
            if (preg_match($key, $this->uri, $matches)) {
                if (!class_exists($value)) {
                    $controllerPath = 'controllers/' . $value . '.php';
                    if (file_exists($controllerPath)) {
                        require_once 'controllers/' . $value . '.php';
                    } else {
                        return false;
                    }
                }
                //add namespace to controller
                $value = '\spalahGallery\controllers\\' . $value;
                $controller = new $value();
                return $controller->execute($matches);
            }
        }

        $matches = [];
        if (preg_match('/^\/(.+)/', $this->uri, $matches)) {

            $matches = explode('/', $matches[1]);
            $controller = ucfirst($matches[0]) . 'Controller';
            if (!class_exists($controller)) {
                $controllerPath = 'controllers/' . $controller . '.php';
                if (file_exists($controllerPath)) {
                    require_once 'controllers/' . $controller . '.php';
                } else {
                    return false;
                }
            }

            //add namespace to controller
            $controller = '\spalahGallery\controllers\\' . $controller;
            $controller = new $controller();
            return $controller->execute($matches);
        }

        return false;
    }

    public static function redirect($url)
    {
        header('Location: ' . $url);
    }
}