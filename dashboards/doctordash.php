<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'doctor') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f8f9;
        }
        .dashboard-card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 5rem;
        }
        .welcome-title {
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-success bg-success">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold" href="#">Doctor Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-outline-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-card text-center">
        <h2 class="welcome-title">Welcome, Dr. <?= htmlspecialchars($_SESSION['name']); ?> 👨‍⚕️</h2>
        <p class="lead">You can view and approve pending medical leave requests submitted by students.</p>
        <a href="../leave/view_all_requests.php" class="btn btn-success btn-lg mt-3">📄 View Leave Requests</a>
    </div>
</div>
</body>
</html>
