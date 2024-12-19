<?php

$dbname = "u282297161_roadmapai";
$dbusername = "u282297161_sheen";
$dbpassword = "Roadmap.2024";
$dbhost = "localhost";

// Create connection
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>