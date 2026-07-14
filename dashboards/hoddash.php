<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SESSION['role'] !== 'hod') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOD Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --hod-color: rgb(162, 98, 204);
        }

        body {
            background-color: #f4f6fa;
        }

        .dashboard-card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 5rem;
        }

        .welcome-title {
            color: var(--hod-color);
            font-weight: bold;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar {
            background-color: var(--hod-color);
        }

        .btn-hod {
            background-color: var(--hod-color);
            color: white;
            border: none;
        }

        .btn-hod:hover {
            background-color: rgb(142, 81, 184);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">HOD Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-outline-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-card text-center col-md-8 mx-auto">
        <h2 class="welcome-title">Welcome, HOD <?= htmlspecialchars($_SESSION['name']); ?> 🧑‍🏫</h2>
        <p class="lead">You can review and approve medical leave requests verified by the Dean.</p>
        <a href="../leave/view_all_requests.php" class="btn btn-hod btn-lg mt-3">📄 View Leave Requests</a>
    </div>
</div>

</body>
</html>
