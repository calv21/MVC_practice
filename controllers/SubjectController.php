<?php
require_once __DIR__ . '/../models/Subject.php';

class SubjectController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Subject($pdo);
    }

    public function create($name, $description) {
        return $this->model->create($name, $description);
    }

    public function update($id, $name, $description) {
        return $this->model->update($id, $name, $description);
    }

    public function delete($id) {
        return $this->model->delete($id);
    }

    public function getAll() {
        return $this->model->getAll();
    }

    public function getById($id) {
        return $this->model->getById($id);
    }
}
