<?php
// Define database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_gallery1";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>