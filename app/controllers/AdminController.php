<?php
// app/controllers/AdminController.php

class AdminController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'user/login');
            exit();
        }
    }

    public function dashboard() {
        $this->view('admin/dashboard', ['title' => 'Панель адміністрування']);
    }
}