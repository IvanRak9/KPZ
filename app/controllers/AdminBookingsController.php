<?php
// app/controllers/AdminBookingsController.php

class AdminBookingsController extends Controller {

    private Booking $bookingModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . 'user/login');
            exit();
        }
        $this->bookingModel = $this->model('Booking');
    }

    public function index() {
        $bookings = $this->bookingModel->getAll();
        $this->view('admin/bookings/index', ['bookings' => $bookings, 'title' => 'Управління бронюваннями']);
    }

    public function approve(int $id) {
        $this->bookingModel->updateStatus($id, 'confirmed');
        header('Location: ' . BASE_URL . 'adminbookings/index');    }

    public function cancel(int $id) {
        $this->bookingModel->updateStatus($id, 'cancelled');
        header('Location: ' . BASE_URL . 'adminbookings/index');    }
}