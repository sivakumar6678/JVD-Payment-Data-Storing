<?php
// Assuming you have a database connection
require 'config.php';

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date and time
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s"); // Current date

// Collect form data
$admission_number = $_POST['admission_number'];
$name = $_POST['name'];
$amount_paid = $_POST['amount_paid'];
$utr_number = $_POST['utr_number'];
$feetype = $_POST['fees_type'];

// SQL query to insert payment details into payment_logs table
$sql_insert = "INSERT INTO payment_logs (Date, Admission_Number, Name, Fees_Type, Amount_paid, UTR_Number) VALUES
               ('$date', '$admission_number','$name','$feetype','$amount_paid', '$utr_number')";

// SQL query to update the corresponding fee column in studentdetails table
$sql_update = "UPDATE studentdetails 
               SET " . getColumnName($feetype) . " = " . getColumnName($feetype) . " - $amount_paid
               WHERE Admission_Number = '$admission_number'";

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

// Execute both queries and handle success or failure
if ($conn->query($sql_insert) === TRUE && $conn->query($sql_update) === TRUE) {
    // On success, redirect with success message
    $msg = "Record updated successfully";
    header("Location: ../admin_links.html#?msg=" . urlencode($msg));
} else {
    // Display error messages if queries fail
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
