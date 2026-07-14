<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'dean') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dean Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
        }
        .dashboard-card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 5rem;
        }
        .welcome-title {
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Dean Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-outline-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-card text-center">
        <h2 class="welcome-title">Welcome, Dean <?= htmlspecialchars($_SESSION['name']); ?> 🎓</h2>
        <p class="lead">View requests approved by doctors and make your decision.</p>
        <a href="../leave/view_all_requests.php" class="btn btn-primary btn-lg mt-3">📄 View Leave Requests</a>
    </div>
</div>
</body>
</html>
