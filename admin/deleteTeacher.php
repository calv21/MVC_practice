<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/TeacherController.php';

$controller = new TeacherController($pdo);
$id = $_GET['id'] ?? null;

if ($id) {
    $controller->delete($id);
}

header("Location: teacher.php");
exit;
