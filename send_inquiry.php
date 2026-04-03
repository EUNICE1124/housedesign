<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['clientName'];
    $service = $_POST['serviceType'];

    // Using Prepared Statements to prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO inquiries (client_name, service_type) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $service);

    if ($stmt->execute()) {
        header("Location: index.html?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>