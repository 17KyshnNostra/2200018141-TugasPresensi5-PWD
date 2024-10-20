<?php
session_start();

// Username dan password admin statis
$admin_username = "admin";
$admin_password = "admin123";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $admin_username && $password === $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
} else {
    // Redirect back to login page with an error message
    header("Location: admin_login.php?error=1");
    exit();
}
?>
