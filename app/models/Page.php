<?php
// app/models/Page.php

class Page {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Отримує всі сторінки (для адмінки)
     */
    public function getAll(): array {
        $stmt = $this->db->query("SELECT id, title, slug, is_published FROM pages ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Отримує всі ОПУБЛІКОВАНІ сторінки (для меню на сайті)
     */
    public function getAllPublished(): array {
        $stmt = $this->db->query("SELECT title, slug FROM pages WHERE is_published = TRUE ORDER BY title ASC");
        return $stmt->fetchAll();
    }

    /**
     * Отримує одну сторінку за її slug (для публічного перегляду)
     */
    public function getBySlug(string $slug): mixed {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE slug = :slug AND is_published = TRUE");
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Отримує одну сторінку за ID (для редагування в адмінці)
     */
    public function getById(int $id): mixed {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Створює нову сторінку
     */
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO pages (title, slug, content, is_published) VALUES (:title, :slug, :content, :is_published)"
        );
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':is_published', $data['is_published'], PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    /**
     * Оновлює сторінку
     */
    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare(
            "UPDATE pages SET title = :title, slug = :slug, content = :content, is_published = :is_published WHERE id = :id"
        );
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':is_published', $data['is_published'], PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /**
     * Видаляє сторінку
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM pages WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}