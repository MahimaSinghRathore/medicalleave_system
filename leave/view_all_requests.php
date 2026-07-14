<?php
require_once '../auth/session.php';
require_once '../config/db.php';

$role = $_SESSION['role'];
$user_name = $_SESSION['name'];

// Handle approval/rejection directly via GET
if (isset($_GET['id']) && isset($_GET['action'])) {
    $leave_id = $_GET['id'];
    $action = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';

    $column = '';
    if ($role === 'doctor') $column = 'doctor_approval';
    elseif ($role === 'dean') $column = 'dean_approval';
    elseif ($role === 'hod') $column = 'hod_approval';
    elseif ($role === 'teacher') $column = 'teacher_approval';

    if ($column) {
       
        $stmt = $pdo->prepare("UPDATE leave_requests SET $column = ? WHERE id = ?");
        $stmt->execute([$action, $leave_id]);

        // Fetch the updated row
        $stmt = $pdo->prepare("SELECT doctor_approval, dean_approval, hod_approval, teacher_approval FROM leave_requests WHERE id = ?");
        $stmt->execute([$leave_id]);
        $leave = $stmt->fetch();

        if ($leave) {
            // Normalize values
            $approvals = array_map(
                fn($v) => strtolower(trim($v ?? 'pending')),
                $leave
            );

            // Determine status
            if (in_array('rejected', $approvals)) {
                $status = 'Rejected';
            } elseif (!in_array('pending', $approvals)) {
                $status = 'Approved';
            } else {
                $status = 'Pending';
            }

            // Update overall status
            $stmt = $pdo->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
            $stmt->execute([$status, $leave_id]);
        }

        header("Location: view_all_requests.php");
        exit();
    }
}

// Fetch requests for this role
if ($role === 'doctor') {
    $stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE doctor_approval = 'Pending' ORDER BY created_at DESC");
} elseif ($role === 'dean') {
    $stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE doctor_approval = 'Approved' AND dean_approval = 'Pending' ORDER BY created_at DESC");
} elseif ($role === 'hod') {
    $stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE doctor_approval = 'Approved' AND dean_approval = 'Approved' AND hod_approval = 'Pending' ORDER BY created_at DESC");
} elseif ($role === 'teacher') {
    $stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE doctor_approval = 'Approved' AND dean_approval = 'Approved' AND hod_approval = 'Approved' AND teacher_approval = 'Pending' ORDER BY created_at DESC");
} else {
    header("Location: ../auth/logout.php");
    exit();
}

$stmt->execute();
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ucfirst($role) ?> Dashboard</title>
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
        <a class="navbar-brand"><?= ucfirst($role) ?> Dashboard</a>
        <div class="d-flex">
            <a class="btn btn-light" href="../auth/logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container bg-white shadow rounded p-4">
    <h2 class="mb-4">Pending Leave Requests</h2>
    <?php if (!empty($requests)): ?>
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Student ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Doctor</th>
                    <th>Dean</th>
                    <th>HOD</th>
                    <th>Teacher</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $req): ?>
                    <tr>
                        <td><?= htmlspecialchars($req['user_id']) ?></td>
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
                        <td>
                            <a href="?id=<?= $req['id'] ?>&action=approve" class="btn btn-success btn-sm">Approve</a>
                            <a href="?id=<?= $req['id'] ?>&action=reject" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">No pending requests for your role.</div>
    <?php endif ?>
</div>

</body>
</html>
