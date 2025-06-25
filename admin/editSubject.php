<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/SubjectController.php';

$controller = new SubjectController($pdo);
$message = '';

// Get subject ID from query
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Subject ID is required.");
}

// Fetch subject data
$subject = $controller->getById($id);
if (!$subject) {
    die("Subject not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    $result = $controller->update($id, $name, $description);
    $message = $result['message'];

    // Refresh subject data after update
    if ($result['success']) {
        $subject = $controller->getById($id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Edit Subject</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Subject Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($subject['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"><?= htmlspecialchars($subject['description']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="subject.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
