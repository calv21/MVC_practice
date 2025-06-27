<?php

class Department {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM departments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM departments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($departmentName, $personInCharge) {
        $stmt = $this->pdo->prepare("INSERT INTO departments (department_name, person_in_charge) VALUES (?, ?)");
        return $stmt->execute([$departmentName, $personInCharge]);
    }

    public function update($id, $departmentName, $personInCharge) {
        $stmt = $this->pdo->prepare("UPDATE departments SET department_name = ?, person_in_charge = ? WHERE id = ?");
        return $stmt->execute([$departmentName, $personInCharge, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM departments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


?>