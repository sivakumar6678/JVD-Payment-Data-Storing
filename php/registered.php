<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the configuration file with database connection details
require 'config.php';

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch values from the form
    $admissionNumber = $_POST["admissionNumber"];
    $scholorshipid = $_POST['scholorshipid'];
    $name = $_POST["name"];
    $jvd = $_POST["jvd"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    $branch = $_POST["branch"];
    $qualify = $_POST["Qualify"];
    $phoneNumber = $_POST["phoneNumber"];
    $acomidation = $_POST["acomidation"];

    try {
        // Prepare and execute the SQL query to insert student details into the database
        $sql = "INSERT INTO studentdetails (`Admission_Number`,Name, Scholorship_Id, `Jvd/Non_Jvd` , `Email_Id`, Year, Branch, `CET_Qualified`, `Phone_Number`, Accommodation)
            VALUES ('$admissionNumber', '$name', '$scholorshipid', '$jvd', '$email', '$year', '$branch', '$qualify', '$phoneNumber', '$acomidation')";

        if ($conn->query($sql) === TRUE) {
            // On successful insertion, redirect with success message
            $success_message = "Record added successfully";
            header("Location: ../file.html#?success_message=" . urlencode($success_message));
        } else {
            // Display error message if the SQL query fails
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        // Catch any exceptions that might occur during execution
        $privio = "Admission Number already exists";
        header("Location: ../file.html#?privio=" . urlencode($privio));
    }

    // Close the database connection
    $conn->close();
}
?>
