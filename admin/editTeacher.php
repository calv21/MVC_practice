<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/TeacherController.php';
require_once __DIR__ . '/../controllers/DepartmentController.php';

$teacherController = new TeacherController($pdo);
$deptController = new DepartmentController($pdo);

$id = $_GET['id'] ?? null;
$teacher = $id ? $teacherController->get($id) : null;
$departments = $deptController->index();
$success = null;
$error = null;

if (!$teacher) {
    $error = "Teacher not found.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $department_id = $_POST['department_id'] ?? null;

    if ($name && $email) {
        $result = $teacherController->update($id, $name, $email, $phone, $department_id);
        $success = $result ? "Teacher updated successfully." : "Failed to update teacher.";
        $teacher = $teacherController->get($id); // refresh data
    } else {
        $error = "Full name and email are required.";
    }
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-pencil-square me-2"></i>Edit Teacher</h3>
        <a href="teacher.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

    <?php if ($teacher): ?>
        <form method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($teacher['full_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($teacher['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($teacher['phone']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Department</label>
                <select name="department_id" class="form-select">
                    <option value="">-- Select Department --</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= $dept['id'] ?>" <?= $teacher['department_id'] == $dept['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dept['department_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save2 me-1"></i>Update</button>
        </form>
    <?php endif; ?>
</div>

<?php include("../layouts/footer.php"); ?>
