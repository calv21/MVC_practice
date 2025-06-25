<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/SubjectController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new SubjectController($pdo);
    $controller->delete($id);
}

// Redirect back to subject list
header("Location: subject.php");
exit;
