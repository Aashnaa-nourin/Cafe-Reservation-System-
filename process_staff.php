<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get staff details from the form
    $name = $_POST["name"];
    $id = $_POST["id"];
    $department = $_POST["department"];

    // You can perform data validation and sanitization here if needed

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

    // Insert staff details into the database
    $sql = "INSERT INTO staff (name, id, department) VALUES ('$name', '$id', '$department')";

    if ($conn->query($sql) === TRUE) {
        echo "Staff details added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
