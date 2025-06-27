<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/DepartmentController.php';

$controller = new DepartmentController($pdo);
$departments = $controller->index();

if (isset($departments['success']) && $departments['success'] === false) {
    $error = $departments['message'];
    $departments = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .page-title {
            font-weight: 600;
            color: #0d6efd;
        }
        .table th {
            background-color: #e9f2ff;
            color: #0d6efd;
            text-align: center;
            vertical-align: middle;
        }
        .table td {
            vertical-align: middle;
            font-size: 15px;
        }
        .action-buttons a {
            margin-right: 6px;
        }
    </style>
</head>
<body class="bg-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title"><i class="bi bi-diagram-3-fill me-2"></i>Department Management</h3>
        <a href="addDepartment.php" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i>Add Department
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Department Name</th>
                    <th>Person in Charge</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $index => $dept): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($dept['department_name']) ?></td>
                        <td><?= htmlspecialchars($dept['person_in_charge']) ?></td>
                        <td class="text-center action-buttons">
                            <a href="editDepartment.php?id=<?= $dept['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="deleteDepartment.php?id=<?= $dept['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this department?')">
                                <i class="bi bi-trash3"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($departments)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No departments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
