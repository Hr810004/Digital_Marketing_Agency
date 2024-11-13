<?php
$host = 'localhost';
$dbname = 'growthgenius';
$username = 'root';
$password = '';

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
