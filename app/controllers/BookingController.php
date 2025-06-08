<?php
// app/controllers/BookingController.php

class BookingController extends Controller {

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingModel = $this->model('Booking');

            $data = [
                'room_id' => $_POST['room_id'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'guest_name' => trim(htmlspecialchars($_POST['guest_name'])),
                'guest_email' => trim(htmlspecialchars($_POST['guest_email'])),
                'guest_phone' => trim(htmlspecialchars($_POST['guest_phone']))
            ];

            if (!$bookingModel->isAvailable($data['room_id'], $data['start_date'], $data['end_date'])) {
                die('Вибачте, хтось щойно забронював ці дати. Спробуйте ще раз.');
            }

            if ($bookingModel->create($data)) {
                $this->view('booking/success');
            } else {
                die('Помилка при створенні бронювання.');
            }
        }
    }
    public function checkAvailability() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $roomId = $_GET['room_id'] ?? null;
            $startDate = $_GET['start_date'] ?? null;
            $endDate = $_GET['end_date'] ?? null;

            if (!$roomId || !$startDate || !$endDate) {
                echo json_encode([
                    'available' => false,
                    'message' => 'Некоректні дані.'
                ]);
                return;
            }

            $bookingModel = $this->model('Booking');
            $isAvailable = $bookingModel->isAvailable($roomId, $startDate, $endDate);

            echo json_encode([
                'available' => $isAvailable,
                'message' => $isAvailable ? 'Номер доступний!' : 'На жаль, номер зайнятий.'
            ]);
        }
    }
}