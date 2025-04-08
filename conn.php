<?php

ob_start();
$conn = new mysqli('localhost', 'root', '', 'cafe');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
ob_end_flush();
?>