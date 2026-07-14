<?php
require_once '../auth/session.php';
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['leave_id'];
    $role = $_POST['role']; 
    $action = $_POST['action']; 

    if (!in_array($action, ['Approved', 'Rejected'])) {
        die('Invalid action');
    }

    $valid_roles = ['doctor', 'dean', 'hod', 'teacher'];
    $role = strtolower(trim($role));
    if (!in_array($role, $valid_roles)) {
        die('Invalid role');
    }

    $approval_column = $role . '_approval';

    $stmt = $pdo->prepare("UPDATE leave_requests SET $approval_column = ? WHERE id = ?");
    $stmt->execute([$action, $request_id]);

    $stmt = $pdo->prepare("SELECT * FROM leave_requests WHERE id = ?");
    $stmt->execute([$request_id]);
    $leave = $stmt->fetch();

    if ($leave) {
        $approvals = array_map(
            fn($col) => strtolower(trim($leave[$col] ?? 'pending')),
            ['doctor_approval', 'dean_approval', 'hod_approval', 'teacher_approval']
        );

        if (in_array('rejected', $approvals)) {
            $final_status = 'Rejected';
        } elseif (!in_array('pending', $approvals)) {
            $final_status = 'Approved';
        } else {
            $final_status = 'Pending';
        }

       
        $stmt = $pdo->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
        $stmt->execute([$final_status, $request_id]);
    }

    header("Location: view_all_requests.php");
    exit();
}
?>
