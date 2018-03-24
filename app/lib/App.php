<?php

/*
 * Core App Class
 * Create URL & Load APP Controller
 * URL Format Controller/Method/Params
*/

class App {
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();
        // config the controller for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.controller.php')) {
            // if exist set as controllers;
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        // Require the Controller and Instantiate
        require_once '../app/controllers/' . $this->currentController . '.controller.php';
        $this->currentController = new $this->currentController();

        // config the Method for second value
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}




















