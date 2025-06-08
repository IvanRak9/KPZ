<?php
// app/controllers/HomeController.php

class HomeController extends Controller {
    public function index() {
        $roomModel = $this->model('Room');
        $rooms = $roomModel->getAll();
        $this->view('home/index', ['title' => 'Головна сторінка', 'rooms' => $rooms]);

    }
}