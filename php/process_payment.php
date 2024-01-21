<?php
require 'config.php';

// Assuming you have received form data
$admission_number = $_POST['admission_number'];
$name = $_POST['name'];
$amount_paid = $_POST['amount_paid'];
$utr_number = $_POST['utr_number'];
$feetype = $_POST['fees_type'];
$dateofpayment = $_POST['datepaid'];

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date and time
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s"); // Current date

// Function to map fee type to column name in studentdetails table
function getColumnName($feetype) {
    // Define the mapping of fee type to column name
    $feeColumnMap = [
        'Tution_Fees' => 'Tution_fee',
        'Special_Fees' => 'Special_fee',
        'UCS_Fees' => 'UCS_fee',
        // Add more fee types as needed
    ];

    // Return the column name based on fee type
    return $feeColumnMap[$feetype];
}

// Check if the Admission_Number exists in studentdetails
$check_query = "SELECT COUNT(*) as count FROM studentdetails WHERE Admission_Number = '$admission_number'";
$result = $conn->query($check_query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $student_exists = $row['count'];

    if ($student_exists) {
        // Admission_Number exists in studentdetails
        // SQL query to insert payment details into payment_logs table
        $sql_insert = "INSERT INTO payment_logs (Date, Admission_Number, Name, Fees_Type, Amount_paid,  Date_of_payment , UTR_Number) VALUES
                       ('$date', '$admission_number','$name','$feetype','$amount_paid' , '$dateofpayment' , '$utr_number')";

        // SQL query to update the corresponding fee column in studentdetails table
        $sql_update = "UPDATE studentdetails 
                       SET " . getColumnName($feetype) . " = " . getColumnName($feetype) . " - $amount_paid
                       WHERE Admission_Number = '$admission_number'";

        // Execute both queries and handle success or failure
        if ($conn->query($sql_insert) === TRUE && $conn->query($sql_update) === TRUE) {
            // On success, redirect with success message
            $msg = "Record updated successfully";
            header("Location: ../admin_links.html#?msg=" . urlencode($msg));
        } else {
            // Display error messages if queries fail
            $error_msg = "Error: " . $sql_insert . "<br>" . $conn->error;
            $error_msg .= "Error: " . $sql_update . "<br>" . $conn->error;
            header("Location: ../admin_links.html#?error=" . urlencode($error_msg));
        }
    } else {
        // Admission_Number doesn't exist in studentdetails
        $error_msg = "Admission number does not exist in student records.";
        header("Location: ../admin_links.html#?error=" . urlencode($error_msg));
    }
} else {
    // Error in query execution
    $error_msg = "Error checking Admission_Number existence.";
    header("Location: ../admin_links.html#?error=" . urlencode($error_msg));
}

// Close the database connection
$conn->close();
?>
