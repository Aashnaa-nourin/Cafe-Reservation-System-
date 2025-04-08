<?php
// Connect to your database (replace with your database credentials)
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling delete request
if(isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    // Perform deletion from the database
    $delete_sql = "DELETE FROM staff WHERE id = $id_to_delete";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: view_staff.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Query to retrieve staff details from the database
$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

// Check if there are any staff details
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Name</th><th>ID</th><th>Department</th><th>Edit</th><th>Delete</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["department"] . "</td>";
        // Edit link
        echo "<td><a href='edit_staff.php?id=" . $row["id"] . "'>Edit</a></td>";
        // Delete link
        echo "<td><a href='view_staff.php?delete=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No staff details found.";
}

$conn->close();
?>
