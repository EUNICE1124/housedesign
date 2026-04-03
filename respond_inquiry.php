<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['inquiry_id']);
    $reply = $conn->real_escape_string($_POST['admin_reply']);

    // Update the inquiry with the reply and change status to 'responded'
    $sql = "UPDATE inquiries SET admin_reply = '$reply', status = 'responded' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?status=replied");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>