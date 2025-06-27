<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/TeacherController.php';

$controller = new TeacherController($pdo);
$teachers = $controller->index();

if (isset($teachers['success']) && $teachers['success'] === false) {
    $error = $teachers['message'];
    $teachers = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table th {
            background-color: #f0f8ff;
            text-align: center;
            vertical-align: middle;
        }
        .table td {
            vertical-align: middle;
        }
        .action-buttons a {
            margin-right: 5px;
        }
    </style>
</head>
<body class="bg-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-person-badge me-2"></i>Teacher Directory</h3>
        <a href="addTeacher.php" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Add Teacher
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $index => $teacher): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($teacher['full_name']) ?></td>
                        <td><?= htmlspecialchars($teacher['email']) ?></td>
                        <td><?= htmlspecialchars($teacher['phone']) ?></td>
                        <td><?= htmlspecialchars($teacher['department_name'] ?? '—') ?></td>
                        <td class="text-center action-buttons">
                            <a href="editTeacher.php?id=<?= $teacher['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="deleteTeacher.php?id=<?= $teacher['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">
                                <i class="bi bi-trash3"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($teachers)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No teachers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
