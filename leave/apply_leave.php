<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id    = $_SESSION['user_id'];
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];
    $reason     = $_POST['reason'];

    $stmt = $pdo->prepare("INSERT INTO leave_requests (user_id, start_date, end_date, reason) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $start_date, $end_date, $reason])) {
        $success = "Leave application submitted successfully.";
    } else {
        $error = "Failed to submit leave application.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #1e3d58;
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffffff;
        }
        .btn-light {
            color: #1e3d58;
        }
        .btn-light:hover {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #1e3d58;
            font-size: 2rem;
            font-weight: bold;
        }
        .alert {
            border-radius: 0.5rem;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
            color: #1e3d58;
        }
        .form-control {
            border-radius: 0.5rem;
            border-color: #d1d8e2;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Medical Leave System</a>
        <div class="d-flex">
            <a class="btn btn-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Apply for Medical Leave</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
