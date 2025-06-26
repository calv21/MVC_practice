<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$controller = new ClassController($pdo);
$classes = $controller->getAll();

if (isset($classes['success']) && $classes['success'] === false) {
    $error = $classes['message'];
    $classes = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .class-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Class List</h3>
        <a href="addClass.php" class="btn btn-primary">+ Add Class</a>
    </div>

    <?php if (!empty($classes)): ?>
        <div class="row">
            <?php foreach ($classes as $class): ?>
                <div class="col-md-4 mb-4">
                    <div class="card class-card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= htmlspecialchars($class['name']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                Section: <?= $class['section'] ? htmlspecialchars($class['section']) : 'N/A' ?>
                            </h6>
                            <p class="mb-2"><strong>Academic Year:</strong> <?= htmlspecialchars($class['academic_year']) ?></p>
                            <p class="text-muted small mb-3">Created: <?= $class['created_at'] ?></p>
                            <a href="editClass.php?id=<?= $class['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="deleteClass.php?id=<?= $class['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No classes found.</div>
    <?php endif; ?>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
