<?php
require 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM materials WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?status=deleted");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>