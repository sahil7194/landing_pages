<?php
$servername = "localhost";
$username = "gorakshag_wm";
$password = "0FqWVG#dQPFO";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>