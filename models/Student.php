<?php
class Student {
    private $pdo;

    // Inject PDO connection via the constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new student record
    public function create($full_name, $email, $phone, $gender, $dob, $address, $class_id) {
        if (empty($full_name)) {
            return ['success' => false, 'message' => 'Full name is required.'];
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO students (full_name, email, phone, gender, dob, address, class_id) 
                                         VALUES (:full_name, :email, :phone, :gender, :dob, :address, :class_id)");
            $stmt->execute([
                ':full_name' => $full_name,
                ':email'     => $email,
                ':phone'     => $phone,
                ':gender'    => $gender,
                ':dob'       => $dob,
                ':address'   => $address,
                ':class_id'  => $class_id,
            ]);
            return ['success' => true, 'message' => 'Student added successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Update an existing student record
    public function update($id, $full_name, $email, $phone, $gender, $dob, $address, $class_id) {
        if (empty($full_name)) {
            return ['success' => false, 'message' => 'Full name is required.'];
        }

        try {
            $stmt = $this->pdo->prepare("UPDATE students 
                                         SET full_name = :full_name, email = :email, phone = :phone, 
                                             gender = :gender, dob = :dob, address = :address, class_id = :class_id
                                         WHERE id = :id");
            $stmt->execute([
                ':id'        => $id,
                ':full_name' => $full_name,
                ':email'     => $email,
                ':phone'     => $phone,
                ':gender'    => $gender,
                ':dob'       => $dob,
                ':address'   => $address,
                ':class_id'  => $class_id,
            ]);
            return ['success' => true, 'message' => 'Student updated successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Delete a student record by id
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM students WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return ['success' => true, 'message' => 'Student deleted successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get all student records
    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM students ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Get a single student record by id
    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
}
