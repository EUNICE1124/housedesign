<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $displayName = $conn->real_escape_string($_POST['blueprintName']);
    
    $target_dir = "uploads/blueprints/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
    
    $file_ext = pathinfo($_FILES["blueprintFile"]["name"], PATHINFO_EXTENSION);
    $file_name = "plan_" . time() . "." . $file_ext;
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["blueprintFile"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO blueprints (display_name, file_path) VALUES ('$displayName', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php?status=plan_success");
        }
    } else {
        echo "Error uploading blueprint.";
    }
}
?>