<?php
include("../layouts/header.php");
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/ClassController.php';

$studentController = new StudentController($pdo);
$classController = new ClassController($pdo);
$classes = $classController->getAll();

$message = '';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $dob       = $_POST['dob'] ?? '';
    $address   = $_POST['address'] ?? '';
    $class_id  = $_POST['class_id'] ?? null;

    $result = $studentController->create($full_name, $email, $phone, $gender, $dob, $address, $class_id);
    $message = $result['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Add New Student</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Class</label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Select Class --</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Add Student</button>
                <a href="student.php" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
</body>
</html>
