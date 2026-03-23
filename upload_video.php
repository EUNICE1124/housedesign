<?php
session_start();
if (!isset($_SESSION['authenticated'])) exit;

$conn = new mysqli("localhost", "root", "25J2007ayaounde", "housedesign_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['companyVideo'])) {
    $title = $conn->real_escape_string($_POST['videoTitle']);
    $targetDir = "uploads/videos/";
    
    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = time() . "_" . basename($_FILES["companyVideo"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["companyVideo"]["tmp_name"], $targetFilePath)) {
        $conn->query("INSERT INTO company_videos (video_title, file_path) VALUES ('$title', '$targetFilePath')");
        header("Location: admin-dashboard.php?upload=success");
    }
}
?>