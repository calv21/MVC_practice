<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$studentController = new StudentController($pdo);
$classController = new ClassController($pdo);
$classes = $classController->getAll();

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Student ID is required.");
}

$student = $studentController->getById($id);
if (!$student) {
    die("Student not found.");
}

$message = '';

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $dob       = $_POST['dob'] ?? '';
    $address   = $_POST['address'] ?? '';
    $class_id  = $_POST['class_id'] ?? null;

    $result = $studentController->update($id, $full_name, $email, $phone, $gender, $dob, $address, $class_id);
    $message = $result['message'];

    if ($result['success']) {
        $student = $studentController->getById($id); // Refresh data
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Edit Student</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($student['full_name']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($student['phone']) ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="Male" <?= $student['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $student['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= $student['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="<?= $student['dob'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($student['address']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Class</label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Select Class --</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>" <?= $student['class_id'] == $class['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($class['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Student</button>
                <a href="student.php" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
