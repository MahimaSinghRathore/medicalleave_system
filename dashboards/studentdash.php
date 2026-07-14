<?php
require_once '../auth/session.php';
require_once '../config/db.php';

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];

// Fetch student's leave requests
$stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f8; }
        .container { margin-top: 50px; }
        h2 { color: #0d6efd; }
        .badge { font-size: 0.85rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand">Student Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-light" href="../leave/apply_leave.php">Apply Leave</a>
            <a class="btn btn-light ms-2" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container bg-white shadow rounded p-4">
    <h2 class="mb-4">Your Leave Requests</h2>

    <?php if (!empty($requests)): ?>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Doctor</th>
                    <th>Dean</th>
                    <th>HOD</th>
                    <th>Teacher</th>
                    <th>Final Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $req): ?>
                    <tr>
                        <td><?= htmlspecialchars($req['start_date']) ?></td>
                        <td><?= htmlspecialchars($req['end_date']) ?></td>
                        <td><?= htmlspecialchars($req['reason']) ?></td>

                        <?php
                        $statuses = ['doctor_approval', 'dean_approval', 'hod_approval', 'teacher_approval'];
                        foreach ($statuses as $col):
                            $status = $req[$col];
                            $color = $status === 'Approved' ? 'success' : ($status === 'Rejected' ? 'danger' : 'warning text-dark');
                        ?>
                            <td><span class="badge bg-<?= $color ?>"><?= $status ?></span></td>
                        <?php endforeach; ?>

                        <?php
                        $final = $req['status'];
                        $final_color = $final === 'Approved' ? 'success' : ($final === 'Rejected' ? 'danger' : 'secondary');
                        ?>
                        <td><span class="badge bg-<?= $final_color ?>"><?= $final ?></span></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">You haven't submitted any leave requests yet.</div>
    <?php endif ?>
</div>

</body>
</html>
