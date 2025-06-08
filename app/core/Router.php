<?php
// app/core/Router.php

class Router {
    protected string $controller = 'HomeController';
    protected string $method = 'index';
    protected array $params = [];

    public function __construct() {
        $this->parseUrl();
    }

    private function parseUrl(): void {
        $url = $_GET['url'] ?? '';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $urlParts = explode('/', $url);

        // Визначення контролера
        if (!empty($urlParts[0])) {
            $controllerName = ucfirst($urlParts[0]) . 'Controller';

            if (file_exists(ROOT . '/app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($urlParts[0]);
            }
        }

        require_once ROOT . '/app/controllers/' . $this->controller . '.php';

        $controllerInstance = new $this->controller;

        // Визначення методу
        if (isset($urlParts[1])) {
            if (method_exists($controllerInstance, $urlParts[1])) {
                $this->method = $urlParts[1];
                unset($urlParts[1]);
            }
        }

        $this->params = $urlParts ? array_values($urlParts) : [];

        call_user_func_array([$controllerInstance, $this->method], $this->params);
    }
}