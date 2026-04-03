<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['materialName']);
    $price = $conn->real_escape_string($_POST['materialPrice']);
    
    // Folder setup
    $target_dir = "uploads/materials/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
    
    // File renaming for safety
    $file_ext = pathinfo($_FILES["materialImage"]["name"], PATHINFO_EXTENSION);
    $file_name = "mat_" . time() . "." . $file_ext;
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["materialImage"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO materials (material_name, price, image_path) VALUES ('$name', '$price', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php?status=mat_success");
        }
    } else {
        echo "Error uploading image.";
    }
}
?>