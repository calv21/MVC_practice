<?php
include("../layouts/header.php");
// Include controller and DB setup
require_once __DIR__ . '/../config/db.php'; // Your PDO connection
require_once __DIR__ . '/../controllers/SubjectController.php';

$controller = new SubjectController($pdo);
$subjects = $controller->getAll();

// Handle potential error structure from getAll()
if (isset($subjects['success']) && $subjects['success'] === false) {
    $error = $subjects['message'];
    $subjects = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Subjects</title>
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
            <h4 class="mb-0">Subject List</h4>
            <a href="addSubject.php" class="btn btn-sm btn-primary">+ Add Subject</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Subject Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?= $subject['id'] ?></td>
                            <td><?= htmlspecialchars($subject['name']) ?></td>
                            <td><?= htmlspecialchars($subject['description']) ?></td>
                            <td><?= $subject['created_at'] ?></td>
                            <td>
                                <a href="editSubject.php?id=<?= $subject['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="deleteSubject.php?id=<?= $subject['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($subjects)): ?>
                        <tr><td colspan="5" class="text-center">No subjects found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<?php include("../layouts/footer.php"); ?>
