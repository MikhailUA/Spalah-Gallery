<?php

class Router {

    private $uri;
    private $routes = [
        '/^\/$/' => 'IndexController',
        '/^\/index$/' => 'IndexController',
        '/^\/user\/([A-Za-z0-9]+)$/' => 'GalleryController',
        '/^\/signup$/' => 'RegisterController',
        '/^\/photo$/' => 'AddPhotoController',
        '/^\/user\/([A-Za-z0-9]+)\/photo\/(\d+)/' => 'PhotoController',
        '/^\/logout$/' => 'IndexController'
    ];

    public function __construct($requestUri) {
        $this->uri = $requestUri;
    }

    public function handle() {
        foreach($this->routes as $key => $value) {
            $matches = [];
            if(preg_match($key, $this->uri, $matches)) {
                if(!class_exists($value)) {
                    $controllerPath = 'controllers/' . $value . '.php';
                    if(file_exists($controllerPath)) {
                        require_once 'controllers/' . $value . '.php';
                    }
                }

                $controller = new $value();
                return $controller->execute($matches);
            }
        }

        return false;
    }

    public static function redirect($url) {
        header('Location: ' . $url);
    }
}