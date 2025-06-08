<?php
// app/controllers/AdminRoomsController.php

class AdminRoomsController extends Controller {

    private Room $roomModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /user/login');
            exit();
        }
        $this->roomModel = $this->model('Room');
    }

    public function index() {
        $rooms = $this->roomModel->getAll();
        $this->view('admin/rooms/index', ['rooms' => $rooms, 'title' => 'Управління номерами']);
    }

    public function create() {
        $this->view('admin/rooms/create', ['title' => 'Додати новий номер']);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = $this->handleImageUpload();

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'capacity' => trim($_POST['capacity']),
                'image_path' => $imagePath
            ];

            if ($this->roomModel->create($data)) {
                header('Location: ' . BASE_URL . 'adminrooms/index');
            } else {
                $this->view('admin/rooms/create', ['error' => 'Не вдалося створити номер.']);
            }
        } else {
            header('Location: ' . BASE_URL . 'adminrooms/create');        }
    }

    public function edit(int $id) {
        $room = $this->roomModel->getById($id);
        if (!$room) {
            http_response_code(404);
            $this->view('error/404');
            exit();
        }
        $this->view('admin/rooms/edit', ['room' => $room, 'title' => 'Редагувати номер']);
    }

    public function update(int $id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = $this->handleImageUpload();

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'capacity' => trim($_POST['capacity']),
                'image_path' => $imagePath
            ];

            if ($this->roomModel->update($id, $data)) {
                header('Location: ' . BASE_URL . 'adminrooms/index');
            } else {
                $this->view('admin/rooms/edit', ['error' => 'Не вдалося оновити номер.', 'rooms' => $data]);
            }
        }
    }

    public function destroy(int $id) {
        $room = $this->roomModel->getById($id);
        if ($room && !empty($room['image_path']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $room['image_path'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $room['image_path']);
        }

        if ($this->roomModel->delete($id)) {
            header('Location: ' . BASE_URL . 'adminrooms/index');
        } else {
            header('Location: ' . BASE_URL . 'adminrooms/index');
        }
    }

    /**
     * Обробляє завантаження файлу зображення
     * @return string|null Шлях до збереженого файлу або null
     */
    private function handleImageUpload(): ?string {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '/uploads/';
            $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                return $uploadDir . $fileName;
            }
        }
        return null;
    }
}