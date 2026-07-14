<?php
require_once '../auth/session.php';
require_once '../config/db.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$history = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Leave History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fb;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #0d6efd;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .btn-light {
            color: #0d6efd;
        }
        .btn-light:hover {
            background-color: #e7f0ff;
        }
        .container {
            max-width: 1000px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0d6efd;
            font-size: 2rem;
            font-weight: bold;
        }
        table {
            margin-top: 20px;
        }
        th, td {
            text-align: center;
        }
        th {
            background-color: #0d6efd;
            color: white;
        }
        td {
            font-size: 0.95rem;
        }
        .badge {
            font-size: 0.9rem;
        }
        .no-history {
            text-align: center;
            font-size: 1.1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Medical Leave System</a>
        <div class="d-flex">
            <a class="btn btn-light ms-2" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Your Medical Leave History</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Doctor</th>
                <th>Dean</th>
                <th>HOD</th>
                <th>Teacher</th>
                <th>Applied On</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($history)): ?>
                <?php foreach ($history as $entry): ?>
                    <tr>
                        <td><?= htmlspecialchars($entry['start_date']); ?></td>
                        <td><?= htmlspecialchars($entry['end_date']); ?></td>
                        <td><?= htmlspecialchars($entry['reason']); ?></td>
                        <td>
                            <?php
                            switch (strtolower($entry['status'])) {
                                case 'approved':
                                    echo '<span class="badge bg-success">Approved</span>';
                                    break;
                                case 'rejected':
                                    echo '<span class="badge bg-danger">Rejected</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                    break;
                            }
                            ?>
                        </td>
                        <td><?= $entry['doctor_approval'] ?? 'Pending' ?></td>
                        <td><?= $entry['dean_approval'] ?? 'Pending' ?></td>
                        <td><?= $entry['hod_approval'] ?? 'Pending' ?></td>
                        <td><?= $entry['teacher_approval'] ?? 'Pending' ?></td>
                        <td><?= htmlspecialchars($entry['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="no-history">No leave history found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
