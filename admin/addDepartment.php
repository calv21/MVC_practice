<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/DepartmentController.php';

$controller = new DepartmentController($pdo);
$success = null;
$error = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['department_name'] ?? '';
    $person = $_POST['person_in_charge'] ?? '';

    if ($name && $person) {
        $result = $controller->store($name, $person);
        if ($result) {
            $success = "Department created successfully.";
        } else {
            $error = "Failed to create department.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-plus-circle me-2"></i>Add New Department</h3>
        <a href="department.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="department_name" class="form-label">Department Name</label>
            <input type="text" name="department_name" id="department_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="person_in_charge" class="form-label">Person in Charge</label>
            <input type="text" name="person_in_charge" id="person_in_charge" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle me-1"></i> Save Department
        </button>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
