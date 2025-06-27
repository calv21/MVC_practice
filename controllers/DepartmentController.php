<?php

require_once __DIR__ . '/../models/Department.php';

class DepartmentController {
    private $department;

    public function __construct($pdo) {
        $this->department = new Department($pdo);
    }

    public function index() {
        return $this->department->getAll();
    }

    public function store($departmentName, $personInCharge) {
        return $this->department->create($departmentName, $personInCharge);
    }

    public function update($id, $departmentName, $personInCharge) {
        return $this->department->update($id, $departmentName, $personInCharge);
    }

    public function delete($id) {
        return $this->department->delete($id);
    }

    public function get($id) {
        return $this->department->getById($id);
    }
}


?>