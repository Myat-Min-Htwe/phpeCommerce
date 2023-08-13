<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "ianimehouse";

// Create a new MySQLi connection
$connection = new mysqli($host, $user, $pass, $db_name);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set the character set (optional, adjust as per your requirements)
$connection->set_charset("utf8mb4");
?>