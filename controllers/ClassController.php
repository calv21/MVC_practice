<?php
require_once __DIR__ . '/../models/ClassModel.php';

class ClassController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ClassModel($pdo);
    }

    public function create($name, $section, $academic_year) {
        return $this->model->create($name, $section, $academic_year);
    }

    public function update($id, $name, $section, $academic_year) {
        return $this->model->update($id, $name, $section, $academic_year);
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
