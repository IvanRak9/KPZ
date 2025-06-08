<?php
// app/controllers/RoomsController.php

class RoomsController extends Controller {

    private Room $roomModel;

    public function __construct() {
        $this->roomModel = $this->model('Room');
    }

    /**
     * Показує сторінку з каталогом усіх номерів
     */
    public function index() {
        $rooms = $this->roomModel->getAll();
        $this->view('rooms/index', ['rooms' => $rooms, 'title' => 'Наші номери']);
    }
}