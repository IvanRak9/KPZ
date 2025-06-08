<?php
// app/controllers/PagesController.php

class PagesController extends Controller {

    private Page $pageModel;

    public function __construct() {
        $this->pageModel = $this->model('Page');
    }

    /**
     * Показує сторінку за її slug
     * URL буде виглядати як /pages/show/about-us
     */
    public function show(string $slug = '') {
        if (empty($slug)) {
            header('Location: /');
            exit();
        }

        $page = $this->pageModel->getBySlug($slug);

        if ($page) {
            $this->view('pages/show', ['page' => $page, 'title' => $page['title']]);
        } else {
            // Використовуємо наш механізм для 404
            http_response_code(404);
            $this->view('error/404');
        }
    }
}