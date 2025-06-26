<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/SubjectController.php';

$controller = new SubjectController($pdo);
$subjects = $controller->getAll();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table thead th {
            vertical-align: middle;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }
        .action-buttons a {
            margin-right: 5px;
        }
        .card-header h4 {
            font-weight: 600;
        }
    </style>
</head>
<script>
    $(document).ready(function () {
        $('table').DataTable();
    });
</script>

<body class="bg-light">

<div class="container mt-5">
    
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-book me-2"></i>Subject List</h4>
            <a href="addSubject.php" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Add Subject
            </a>
        </div>
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
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
                                <td class="text-center"><?= $subject['id'] ?></td>
                                <td><?= htmlspecialchars($subject['name']) ?></td>
                                <td><?= htmlspecialchars($subject['description']) ?></td>
                                <td><?= $subject['created_at'] ?></td>
                                <td class="text-center action-buttons">
                                    <a href="editSubject.php?id=<?= $subject['id'] ?>" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="deleteSubject.php?id=<?= $subject['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash3"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($subjects)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No subjects found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
