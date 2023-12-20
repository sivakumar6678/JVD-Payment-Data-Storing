<?php
require 'config.php'; // Including the database connection
$error_message = ""; // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Checks if the request method is POST

    // Retrieving form fields
    $uname = $_POST['username']; // Fetching username from the form
    $upass = $_POST['password']; // Fetching password from the form

    // Creating a SQL query to check credentials
    $sql = "SELECT * FROM admin WHERE username = '$uname' AND password = '$upass'";
    $mysqls = mysqli_query($conn, $sql); // Executing the query
    $no = mysqli_num_rows($mysqls); // Getting the number of rows returned by the query

    if ($no >= 1) { // If at least one matching record is found
        // Redirect to the admin_links.html page on successful login
        header("Location: ../admin_links.html");
    } else {
        // If no matching record is found, redirect to the home.html page with an error message
        $error_message = "Invalid username or password"; // Set error message for invalid entries
        header("Location: ../home.html?error_message=" . urlencode($error_message));
        exit(); // Stop further script execution
    }
}
?>
