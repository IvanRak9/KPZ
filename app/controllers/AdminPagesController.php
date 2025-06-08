<?php
// app/controllers/AdminPagesController.php

class AdminPagesController extends Controller {

    private Page $pageModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'user/login');
            exit();
        }
        $this->pageModel = $this->model('Page');
    }

    public function index() {
        $pages = $this->pageModel->getAll();
        $this->view('admin/pages/index', ['pages' => $pages, 'title' => 'Управління сторінками']);
    }

    public function create() {
        $this->view('admin/pages/create', ['title' => 'Створити сторінку']);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'slug' => $this->createSlug(trim($_POST['slug'] ?: $_POST['title'])),
                'content' => trim($_POST['content']),
                'is_published' => isset($_POST['is_published']) ? 1 : 0
            ];

            if ($this->pageModel->create($data)) {
                header('Location: ' . BASE_URL . 'adminpages/index');
            } else {
                $this->view('admin/pages/create', ['error' => 'Не вдалося створити сторінку.', 'data' => $data]);
            }
        }
    }

    public function edit(int $id) {
        $page = $this->pageModel->getById($id);
        $this->view('admin/pages/edit', ['page' => $page, 'title' => 'Редагувати сторінку']);
    }

    public function update(int $id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'slug' => $this->createSlug(trim($_POST['slug'] ?: $_POST['title'])),
                'content' => trim($_POST['content']),
                'is_published' => isset($_POST['is_published']) ? 1 : 0
            ];

            if ($this->pageModel->update($id, $data)) {
                header('Location: ' . BASE_URL . 'adminpages/index');
            } else {
                $this->view('admin/pages/edit', ['error' => 'Не вдалося оновити сторінку.', 'page' => $data]);
            }
        }
    }

    public function destroy(int $id) {
        $this->pageModel->delete($id);
        header('Location: ' . BASE_URL . 'adminpages/index');
    }

    /**
     * Проста функція для створення URL-friendly slug
     */
    private function createSlug(string $text): string {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return $text ?: 'n-a';
    }
}