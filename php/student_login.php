<?php
// Include the database connection configuration file
require 'config.php';

// Initialize the error message variable
$error_message = "";

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and fetch form field values
    $admissionNumber = $_POST['admissionNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    
    // Prepare SQL query to check for matching admission number and phone number
    $sql = "SELECT * FROM studentdetails WHERE `Admission_Number` = '$admissionNumber' AND `Phone_Number` = '$phoneNumber'";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Get the number of rows returned from the query
    $numRows = mysqli_num_rows($result);

    // Start a session
    session_start();

    // Set the admission number in the session, assuming successful login
    $_SESSION['admissionNumber'] = $admissionNumber;

    // Check if matching records are found
    if ($numRows >= 1) {
        // Redirect to the student links page upon successful validation
        header("Location:../student_links.html");
        exit();
    } else {
        // Set error message for invalid admission number or phone number
        $error_message = "Invalid Admission Number or Phone Number. Please try again.";

        // Redirect back to the home page with the error message in the URL
        header("Location: ../home.html#?error_message=" . urlencode($error_message));
        exit();
    }
}
?>
