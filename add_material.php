<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['materialName']);
    $price = $conn->real_escape_string($_POST['materialPrice']);

    $sql = "INSERT INTO materials (material_name, price) VALUES ('$name', '$price')";

    if ($conn->query($sql) === TRUE) {
        // This takes the admin back to the dashboard immediately
        header("Location: admin.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>