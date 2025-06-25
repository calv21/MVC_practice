<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$controller = new ClassController($pdo);
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $section = $_POST['section'] ?? '';
    $academic_year = $_POST['academic_year'] ?? '';

    $result = $controller->create($name, $section, $academic_year);
    $message = $result['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Class</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Class Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="section" class="form-label">Section</label>
                    <input type="text" class="form-control" name="section" id="section">
                </div>
                <div class="mb-3">
                    <label for="academic_year" class="form-label">Academic Year</label>
                    <input type="text" class="form-control" name="academic_year" id="academic_year" placeholder="e.g. 2024-2025" required>
                </div>
                <button type="submit" class="btn btn-success">Add Class</button>
                <a href="class.php" class="btn btn-secondary">View Classes</a>
            </form>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
