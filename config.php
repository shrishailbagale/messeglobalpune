<?php
$servername = "localhost";
$username = "wp440";
$password = "9v1XkH!14p";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>