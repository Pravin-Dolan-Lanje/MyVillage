<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Add password if set
$dbname = "Siregaon_bandh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
