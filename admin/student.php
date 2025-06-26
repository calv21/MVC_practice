<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$studentController = new StudentController($pdo);
$classController = new ClassController($pdo);

$students = $studentController->getAll();
$classes = $classController->getAll();

// Create an easy lookup array for class names
$classNames = [];
foreach ($classes as $c) {
    $classNames[$c['id']] = $c['name'];
}

// Handle error structure if needed
if (isset($students['success']) && $students['success'] === false) {
    $error = $students['message'];
    $students = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
    $(document).ready(function () {
        $('table').DataTable();
    });
</script>
<body class="bg-light">

<div class="container mt-5">
    <div class="">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Student List</h4>
            <a href="addStudent.php" class="btn btn-sm btn-primary">+ Add Student</a>
        </div>
        <div class="card-body mt-3">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Class</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td class="text-center"><?= $student['id'] ?></td>
                            <td><?= htmlspecialchars($student['full_name']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['phone']) ?></td>
                            <td><?= htmlspecialchars($student['gender']) ?></td>
                            <td><?= htmlspecialchars($student['dob']) ?></td>
                            <td><?= $classNames[$student['class_id']] ?? 'N/A' ?></td>
                            <td><?= $student['created_at'] ?></td>
                            <td class="text-center">
                                <a href="editStudent.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="deleteStudent.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($students)): ?>
                        <tr><td colspan="9" class="text-center text-muted">No students found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
