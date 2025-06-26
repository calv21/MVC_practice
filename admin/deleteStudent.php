<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/StudentController.php';

$controller = new StudentController($pdo);

// Get the ID from URL
$id = $_GET['id'] ?? null;

if ($id) {
    $controller->delete($id);
}

// Redirect back to the student list
header("Location: student.php");
exit;
