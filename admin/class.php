<?php
include("../layouts/header.php");
// Include controller and DB setup
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$controller = new ClassController($pdo);
$classes = $controller->getAll();

// Handle potential error structure
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
    <script>
    $(document).ready(function () {
        $('table').DataTable();
    });
    </script>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Class List</h4>
            <a href="addClass.php" class="btn btn-sm btn-primary">+ Add Class</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Class Name</th>
                        <th>Section</th>
                        <th>Academic Year</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classes as $class): ?>
                        <tr>
                            <td><?= $class['id'] ?></td>
                            <td><?= htmlspecialchars($class['name']) ?></td>
                            <td><?= htmlspecialchars($class['section']) ?></td>
                            <td><?= htmlspecialchars($class['academic_year']) ?></td>
                            <td><?= $class['created_at'] ?></td>
                            <td>
                                <a href="editClass.php?id=<?= $class['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="deleteClass.php?id=<?= $class['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($classes)): ?>
                        <tr><td colspan="6" class="text-center">No classes found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<?php include("../layouts/footer.php"); ?>
