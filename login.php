<?php
ob_start();
session_start();
require 'db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['adminName'];
    $pass = $_POST['adminPass'];

    // 1. Prepare a statement to find the user in the database
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // 2. Compare the typed password with the scrambled hash in the DB
        if (password_verify($pass, $row['password_hash'])) {
            $_SESSION['isAdmin'] = true;
            header("Location: admin.php");
            exit();
        } else {
            $error = "Access Denied: Invalid Credentials";
        }
    } else {
        $error = "Access Denied: Invalid Credentials";
    }
    $stmt->close();
}
?>