<?php
// app/models/User.php

class User {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Знаходить користувача за ім'ям
     * @param string $username
     * @return mixed (асоціативний масив або false)
     */
    public function findByUsername(string $username): mixed {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }
}