<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$controller = new ClassController($pdo);
$message = '';

// Get class ID from query
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Class ID is required.");
}

// Fetch class data
$class = $controller->getById($id);
if (!$class) {
    die("Class not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $section = $_POST['section'] ?? null;
    $academic_year = $_POST['academic_year'] ?? '';

    $result = $controller->update($id, $name, $section, $academic_year);
    $message = $result['message'];

    // Refresh class data after update
    if ($result['success']) {
        $class = $controller->getById($id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Edit Class</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Class Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($class['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Section</label>
                    <input type="text" name="section" class="form-control" value="<?= htmlspecialchars($class['section']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Academic Year</label>
                    <input type="text" name="academic_year" class="form-control" value="<?= htmlspecialchars($class['academic_year']) ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="class.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
