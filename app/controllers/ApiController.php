<?php
// app/controllers/ApiController.php

class ApiController extends Controller {

    private Booking $bookingModel;

    public function __construct() {
        $this->bookingModel = $this->model('Booking');
    }

    /**
     * Endpoint для перевірки доступності номера.
     * Відповідає у форматі JSON.
     */
    public function check_availability() {
        header('Content-Type: application/json');

        if (!isset($_GET['room_id']) || !isset($_GET['start_date']) || !isset($_GET['end_date'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['available' => false, 'message' => 'Недостатньо параметрів для перевірки.']);
            return;
        }

        $roomId = (int)$_GET['room_id'];
        $startDate = $_GET['start_date'];
        $endDate = $_GET['end_date'];

        // Проста валідація
        if ($startDate >= $endDate) {
            echo json_encode(['available' => false, 'message' => 'Дата виїзду має бути пізнішою за дату заїзду.']);
            return;
        }

        $isAvailable = $this->bookingModel->isAvailable($roomId, $startDate, $endDate);

        if ($isAvailable) {
            echo json_encode(['available' => true, 'message' => 'Номер вільний на вибрані дати!']);
        } else {
            echo json_encode(['available' => false, 'message' => 'На жаль, номер вже зайнятий на ці дати.']);
        }
    }
}