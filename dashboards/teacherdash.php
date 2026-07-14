<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #0d6efd;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .btn-outline-light {
            border-color: #ffffff;
            color: #ffffff;
        }
        .btn-outline-light:hover {
            background-color: #ffffff;
            color: #0d6efd;
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
            font-size: 2rem;
        }
        .lead {
            color: #333;
            font-size: 1.2rem;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #084298;
            border-color: #084298;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Teacher Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-outline-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-card text-center">
        <h2 class="welcome-title">Welcome, Teacher <?= htmlspecialchars($_SESSION['name']); ?> 📚</h2>
        <p class="lead">Manage your leave requests and stay updated with student leave approvals.</p>
        <a href="../leave/view_all_requests.php" class="btn btn-primary btn-lg mt-3">📄 View Leave Requests</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
