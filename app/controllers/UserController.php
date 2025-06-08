<?php
// app/controllers/UserController.php

class UserController extends Controller {

    private User $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    /**
     * Обробляє логіку входу: показує форму або обробляє POST-запит
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));

            $user = $this->userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $this->createUserSession($user);
                header('Location: ' . BASE_URL . 'admin/dashboard');
                exit();
            } else {
                $this->view('users/login', ['error' => 'Неправильне ім\'я користувача або пароль.']);
            }

        } else {
            if (isset($_SESSION['user_id'])) {
                header('Location: /admin/dashboard');
                exit();
            }
            $this->view('users/login', ['title' => 'Вхід']);
        }
    }

    /**
     * Створює сесію для користувача
     * @param array $user
     */
    private function createUserSession(array $user): void {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }

    /**
     * Обробляє вихід з системи
     */
    public function logout(): void {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        session_destroy();

        header('Location: /');
        exit();
    }
}