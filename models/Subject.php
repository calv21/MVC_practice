<?php
class Subject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $description) {
        if (empty($name)) {
            return ['success' => false, 'message' => 'Subject name is required.'];
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO subjects (name, description) VALUES (:name, :description)");
            $stmt->execute([
                ':name' => $name,
                ':description' => $description
            ]);
            return ['success' => true, 'message' => 'Subject added successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function update($id, $name, $description) {
        if (empty($name)) {
            return ['success' => false, 'message' => 'Subject name is required.'];
        }

        try {
            $stmt = $this->pdo->prepare("UPDATE subjects SET name = :name, description = :description WHERE id = :id");
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':description' => $description
            ]);
            return ['success' => true, 'message' => 'Subject updated successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM subjects WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return ['success' => true, 'message' => 'Subject deleted successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM subjects ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM subjects WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
