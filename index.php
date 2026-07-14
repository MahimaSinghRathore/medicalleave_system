<?php
session_start();

if (isset($_SESSION['role'])) {
    $roleDashMap = [
        'student' => 'dashboards/studentdash.php',
        'doctor'  => 'dashboards/doctordash.php',
        'teacher' => 'dashboards/teacherdash.php',
        'hod'     => 'dashboards/hoddash.php',
        'dean'    => 'dashboards/deandash.php',
    ];

    $role = $_SESSION['role'];

    if (isset($roleDashMap[$role])) {
        header("Location: {$roleDashMap[$role]}");
        exit();
    } else {
        echo "Unknown role: $role";
    }
} else {
    header("Location: auth/login.php");
    exit();
}
