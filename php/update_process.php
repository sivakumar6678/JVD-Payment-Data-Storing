<?php
// Require the database configuration file
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get the new years from the form data
       
            $update_sql = "UPDATE studentdetails 
                           SET `Year` = `Year`  + 1 ";

            $conn->query($update_sql);
        

        // Redirect with success message after updating
        $success_message = "All student years updated successfully";
        header("Location: ../file.html#?success_message=" . urlencode($success_message));
    } catch (Exception $e) {
        // Handle exceptions, redirect with error message
        $privio = "An error occurred while updating student years";
        header("Location: ../file.html#?privio=" . urlencode($privio));
    }
} else {
    // If not a POST request, redirect with error message
    $privio = "Invalid request";
    header("Location: ../file.html#?privio=" . urlencode($privio));
}

// Close the database connection
$conn->close();
?>
