<?php
// app/controllers/ReviewsController.php

class ReviewsController extends Controller {

    private Review $reviewModel;

    public function __construct() {
        $this->reviewModel = $this->model('Review');
    }

    /**
     * Показує сторінку з відгуками та формою для додавання нового
     */
    public function index() {
        $approvedReviews = $this->reviewModel->getAllApproved();
        $this->view('reviews/index', ['reviews' => $approvedReviews, 'title' => 'Відгуки наших гостей']);
    }

    /**
     * Зберігає новий відгук для модерації
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'author_name' => trim(htmlspecialchars($_POST['author_name'])),
                'rating' => (int)$_POST['rating'],
                'review_text' => trim(htmlspecialchars($_POST['review_text']))
            ];

            // Проста валідація
            if (!empty($data['author_name']) && !empty($data['review_text']) && $data['rating'] >= 1 && $data['rating'] <= 5) {
                if ($this->reviewModel->create($data)) {
                    $this->view('reviews/success');
                } else {
                    die('Помилка при збереженні відгука.');
                }
            } else {
                header('Location: /reviews/index');
            }
        }
    }
}