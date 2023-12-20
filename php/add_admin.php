<?php
// Assuming you have a database connection
require 'config.php'; // Including the database connection

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Display error message if connection fails
}

// Getting username and password from the form data
$username = $_POST['username'];
$password = $_POST['password'];

// SQL query to insert admin data into the 'admin' table
$sql_insert = "INSERT INTO admin (username,password) VALUES ('$username', '$password')";

// Executing the SQL query
if ($conn->query($sql_insert) === TRUE) {
    // If insertion is successful
    $msg = "Admin Added successfully"; // Success message
    header("Location: ../admin_links.html#?msg=" . urlencode($msg)); // Redirecting with success message in URL
} else {
    // If there's an error in the SQL query
    echo "Error: " . $sql_insert . "<br>" . $conn->error; // Displaying the error message
}

$conn->close(); // Closing the database connection
?>
