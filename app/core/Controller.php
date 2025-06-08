<?php
// app/core/Controller.php

abstract class Controller {
    public function model(string $model) {
        // Використовуємо ROOT
        require_once ROOT . '/app/models/' . $model . '.php';
        return new $model();
    }

    public function view(string $view, array $data = []) {
        if (!isset($data['pages_for_menu'])) {
            $pageModel = $this->model('Page');
            $data['pages_for_menu'] = $pageModel->getAllPublished();
        }

        ob_start();

        if (file_exists(ROOT . '/app/views/' . $view . '.php')) {
            extract($data);
            require_once ROOT . '/app/views/' . $view . '.php';
        } else {
            http_response_code(404);
            require_once ROOT . '/app/views/error/404.php';
        }

        $content = ob_get_clean();
        echo $content;
    }
}