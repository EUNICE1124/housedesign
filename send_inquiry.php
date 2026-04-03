<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection
    $name = $conn->real_escape_string($_POST['clientName']);
    $service = $conn->real_escape_string($_POST['serviceType']);

    $sql = "INSERT INTO inquiries (client_name, service_type) VALUES ('$name', '$service')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to home with success status
        header("Location: index.html?status=success");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>