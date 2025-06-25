<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new ClassController($pdo);
    $controller->delete($id);
}

// Redirect back to class list
header("Location: class.php");
exit;
