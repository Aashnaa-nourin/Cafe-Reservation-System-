<?php

include("../conn.php");

$query = "SELECT * FROM time_slots";
$result = $conn->query($query);

// Fetch rows as an associative array
$slots = [];
while ($row = $result->fetch_all(MYSQLI_ASSOC)) {
    $slots[] = $row;
}

header('Content-Type: application/json');

// Return the slots as JSON with pretty print for better readability
echo $slots;
?>