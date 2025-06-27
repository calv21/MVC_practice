<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/DepartmentController.php';

$controller = new DepartmentController($pdo);

// Get ID from URL
$id = $_GET['id'] ?? null;

// If ID is valid, delete the department
if ($id) {
    $controller->delete($id);
}

// Redirect to department list after deletion
header("Location: department.php");
exit;
