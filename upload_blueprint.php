<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["blueprint"])) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["blueprint"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["blueprint"]["tmp_name"], $target_file)) {
        // Save file name to database
        $sql = "INSERT INTO blueprints (file_name) VALUES ('$file_name')";
        $conn->query($sql);
        header("Location: admin.php?status=uploaded");
    } else {
        echo "Error uploading file.";
    }
}
?>