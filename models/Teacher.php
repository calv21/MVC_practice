<?php

class Teacher {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT teachers.*, departments.department_name 
            FROM teachers 
            LEFT JOIN departments ON teachers.department_id = departments.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM teachers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $phone, $department_id) {
        $stmt = $this->pdo->prepare("INSERT INTO teachers (full_name, email, phone, department_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $phone, $department_id]);
    }

    public function update($id, $name, $email, $phone, $department_id) {
        $stmt = $this->pdo->prepare("UPDATE teachers SET full_name = ?, email = ?, phone = ?, department_id = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $department_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM teachers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


?>