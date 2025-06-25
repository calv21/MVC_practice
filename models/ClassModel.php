<?php
    class ClassModel{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function create($name, $section, $academic_year) {
            if (empty($name)) {
                return ['success' => false, 'message' => 'Class name is required.'];
            }

            try {
                $stmt = $this->pdo->prepare("INSERT INTO classes (name, section, academic_year) VALUES (:name, :section, :academic_year)");
                $stmt->execute([
                    ':name' => $name,
                    ':section' => $section,
                    ':academic_year' => $academic_year
                ]);
                return ['success' => true, 'message' => 'Class added successfully!'];
            } catch (PDOException $e) {
                return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
            }
        }

        public function update($id, $name, $section, $academic_year) {
            if (empty($name)) {
                return ['success' => false, 'message' => 'Class name is required.'];
            }

            try {
                $stmt = $this->pdo->prepare("UPDATE classes SET name = :name, section = :section, academic_year = :academic_year WHERE id = :id");
                $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':section' => $section,
                ':academic_year' => $academic_year
            ]);
            return ['success' => true, 'message' => 'Class updated successfully!'];
            } catch (PDOException $e) {
                return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
            }
        }

        public function delete($id) {
            try {
                $stmt = $this->pdo->prepare("DELETE FROM classes WHERE id = :id");
                $stmt->execute([':id' => $id]);
                return ['success' => true, 'message' => 'Class deleted successfully!'];
            } catch (PDOException $e) {
                return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
            }
        }

        public function getAll() {
            try {
                $stmt = $this->pdo->query("SELECT * FROM classes ORDER BY id DESC");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return [];
            }
        }

        public function getById($id) {
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM classes WHERE id = :id");
                $stmt->execute([':id' => $id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return null;
            }
        }


    }
?>