<?php
// app/controllers/AdminReviewsController.php

class AdminReviewsController extends Controller {

    private Review $reviewModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'user/login');
            exit();
        }
        $this->reviewModel = $this->model('Review');
    }

    /**
     * Показує всі відгуки для модерації
     */
    public function index() {
        $allReviews = $this->reviewModel->getAllForAdmin();
        $this->view('admin/reviews/index', ['reviews' => $allReviews, 'title' => 'Модерація відгуків']);
    }

    /**
     * Схвалює відгук
     */
    public function approve(int $id) {
        $this->reviewModel->updateStatus($id, 'approved');
        header('Location: ' . BASE_URL . 'adminreviews/index');
    }

    /**
     * Відхиляє відгук
     */
    public function reject(int $id) {
        $this->reviewModel->updateStatus($id, 'rejected');
        header('Location: ' . BASE_URL . 'adminreviews/index');
    }

    /**
     * Видаляє відгук
     */
    public function destroy(int $id) {
        $this->reviewModel->delete($id);
        header('Location: ' . BASE_URL . 'adminreviews/index');
    }
}