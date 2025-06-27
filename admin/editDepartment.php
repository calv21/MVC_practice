<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/DepartmentController.php';

$controller = new DepartmentController($pdo);
$success = null;
$error = null;

// Get department ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: department.php");
    exit;
}

// Fetch current department data
$department = $controller->get($id);
if (!$department) {
    $error = "Department not found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['department_name'] ?? '';
    $person = $_POST['person_in_charge'] ?? '';

    if ($name && $person) {
        $result = $controller->update($id, $name, $person);
        if ($result) {
            $success = "Department updated successfully.";
            // Refresh department data
            $department = $controller->get($id);
        } else {
            $error = "Failed to update department.";
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
    <title>Edit Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-pencil-square me-2"></i>Edit Department</h3>
        <a href="department.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($department): ?>
        <form method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="department_name" class="form-label">Department Name</label>
                <input type="text" name="department_name" id="department_name" class="form-control" value="<?= htmlspecialchars($department['department_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="person_in_charge" class="form-label">Person in Charge</label>
                <input type="text" name="person_in_charge" id="person_in_charge" class="form-control" value="<?= htmlspecialchars($department['person_in_charge']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save2 me-1"></i> Update Department
            </button>
        </form>
    <?php endif; ?>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
