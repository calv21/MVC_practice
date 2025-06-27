<?php

require_once __DIR__ . '/../models/Teacher.php';

class TeacherController {
    private $teacher;

    public function __construct($pdo) {
        $this->teacher = new Teacher($pdo);
    }

    public function index() {
        return $this->teacher->getAll();
    }

    public function store($name, $email, $phone, $department_id) {
        return $this->teacher->create($name, $email, $phone, $department_id);
    }

    public function update($id, $name, $email, $phone, $department_id) {
        return $this->teacher->update($id, $name, $email, $phone, $department_id);
    }

    public function delete($id) {
        return $this->teacher->delete($id);
    }

    public function get($id) {
        return $this->teacher->getById($id);
    }
}


?>