<?php
// app/models/Booking.php

class Booking {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Перевіряє, чи вільний номер у вказаному діапазоні дат.
     * Логіка: шукає бронювання, які ПЕРЕТИНАЮТЬСЯ із заданим періодом.
     * @param int $roomId
     * @param string $startDate
     * @param string $endDate
     * @return bool (true - вільний, false - зайнятий)
     */
    public function isAvailable(int $roomId, string $startDate, string $endDate): bool {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as count FROM bookings 
             WHERE room_id = :room_id 
             AND status = 'confirmed'
             AND (start_date < :end_date AND end_date > :start_date)"
        );
        $stmt->bindParam(':room_id', $roomId);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result['count'] == 0;
    }

    /**
     * Створює нове бронювання
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO bookings (room_id, start_date, end_date, guest_name, guest_email, guest_phone) 
             VALUES (:room_id, :start_date, :end_date, :guest_name, :guest_email, :guest_phone)"
        );
        $stmt->bindParam(':room_id', $data['room_id']);
        $stmt->bindParam(':start_date', $data['start_date']);
        $stmt->bindParam(':end_date', $data['end_date']);
        $stmt->bindParam(':guest_name', $data['guest_name']);
        $stmt->bindParam(':guest_email', $data['guest_email']);
        $stmt->bindParam(':guest_phone', $data['guest_phone']);

        return $stmt->execute();
    }

    // --- Методи для адмін-панелі ---

    public function getAll(): array {
        $stmt = $this->db->query(
            "SELECT b.*, r.name as room_name 
             FROM bookings b
             JOIN rooms r ON b.room_id = r.id
             ORDER BY b.created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->db->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}