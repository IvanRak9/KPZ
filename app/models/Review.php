<?php
// app/models/Review.php

class Review {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Створює новий відгук (зі статусом 'pending')
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO reviews (author_name, rating, review_text) VALUES (:author_name, :rating, :review_text)"
        );
        $stmt->bindParam(':author_name', $data['author_name']);
        $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_INT);
        $stmt->bindParam(':review_text', $data['review_text']);

        return $stmt->execute();
    }

    /**
     * Отримує всі СХВАЛЕНІ відгуки (для публічної сторінки)
     */
    public function getAllApproved(): array {
        $stmt = $this->db->query("SELECT * FROM reviews WHERE status = 'approved' ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Отримує ВСІ відгуки (для адмін-панелі)
     */
    public function getAllForAdmin(): array {
        $stmt = $this->db->query("SELECT * FROM reviews ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Оновлює статус відгука (схвалити/відхилити)
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->db->prepare("UPDATE reviews SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Видаляє відгук
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}