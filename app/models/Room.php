<?php
// app/models/Room.php

class Room {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Отримує всі номери з бази даних
     * @return array
     */
    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM rooms ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    /**
     * Отримує один номер за його ID
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed {
        $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Створює новий номер
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO rooms (name, description, price_per_night, capacity, image_path) 
             VALUES (:name, :description, :price, :capacity, :image_path)"
        );
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':capacity', $data['capacity']);
        $stmt->bindParam(':image_path', $data['image_path']);

        return $stmt->execute();
    }

    /**
     * Оновлює дані номера
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool {
        $sql = "UPDATE rooms SET 
                    name = :name, 
                    description = :description, 
                    price_per_night = :price, 
                    capacity = :capacity";

        if (!empty($data['image_path'])) {
            $sql .= ", image_path = :image_path";
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':capacity', $data['capacity']);
        $stmt->bindParam(':id', $id);
        if (!empty($data['image_path'])) {
            $stmt->bindParam(':image_path', $data['image_path']);
        }

        return $stmt->execute();
    }

    /**
     * Видаляє номер
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}