<?php
$host = "localhost";
$username = "webuser";
$password = "WebPass123!";
$database = "CAT2";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
