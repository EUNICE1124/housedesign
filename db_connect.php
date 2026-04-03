<?php
$servername = "REX";
$username = "root";
$password = "25J2007ayaounde";
$dbname = "housedesign_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");



?>