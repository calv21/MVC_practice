<?php
require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Student($pdo);
    }

    public function create($full_name, $email, $phone, $gender, $dob, $address, $class_id) {
        return $this->model->create($full_name, $email, $phone, $gender, $dob, $address, $class_id);
    }

    public function update($id, $full_name, $email, $phone, $gender, $dob, $address, $class_id) {
        return $this->model->update($id, $full_name, $email, $phone, $gender, $dob, $address, $class_id);
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
