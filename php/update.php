<?php


// updateuser.php

// Include the database configuration file
require 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize an array to store user data
    $userData = array();

    // Collect form data
    foreach ($_POST as $key => $value) {
        // Ensure the key is not empty and starts with a letter (to avoid potential security issues)
        if (!empty($key)) {
            // Sanitize and store the data
            $userData[$key] = mysqli_real_escape_string($conn, $value);
        }
    }

    // Check if there is any data to update
    if (!empty($userData)) {
        // Build the SQL query to update data in the database
        $updateData = array();
        foreach ($userData as $key => $value) {
            $updateData[] = "`$key` = '$value'";
        }
        $updateValues = implode(', ', $updateData);

        // Ensure that there is a valid 'id' value in the $userData array
        if (isset($userData['ID'])) {
            $query = "UPDATE `studentdetails` SET $updateValues WHERE `id` = {$userData['ID']}";

            // Perform the query
            $result = mysqli_query($conn, $query);

            // Check if the query was successful
            if ($result) {
                // Redirect or display a success message
                $msg = "Data Updated Successfully";
                header("Location: admin_student.php#?msg=" . urlencode($msg));
                // header("Location:admin_student.php?status=1");
            } else {
                echo "Error: " . mysqli_error($conn);
                $error_msg = "Error";
                header("Location: admin_student.php#?error_msg=" . urlencode($error_msg));
                // header("Location:admin_student.php?status=2");
            }
        } else {
            echo "Error: No valid 'id' provided for the update.";
        }
    } else {
        $error_msg = "Error: No data provided for the update.";
        header("Location: admin_student.php#?error_msg=" . urlencode($error_msg));
        // header("Location:admin_student.php?status=2");
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the form page if accessed directly without submitting the form
     header("Location: viewStudent.php");
    exit();
}
?>
