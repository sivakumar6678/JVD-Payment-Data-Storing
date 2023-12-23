<?php

    // Require the database configuration file
    require 'config.php';


    // Check if the form is submitted via POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch values from the submitted form
        $AdmissionFee = $_POST["AdmissionFee"];
        $yearSelection = $_POST["yearSelection"];

        try {
            // Prepare and execute the SQL query to update fee details for a specific year
            $sql = "UPDATE studentdetails 
                    SET `Admission_Fees` = '$AdmissionFee'
                    WHERE `Year` = '$yearSelection' and Admission_Number like '%KA5A%' ";

            // Execute the SQL query and handle success or error
            if ($conn->query($sql) === TRUE) {
                // On successful update, redirect with success message
                $success_message = "Fees updated successfully for year $yearSelection";
                header("Location: ../file.html#?success_message=" . urlencode($success_message));
            } else {
                // Display error message if the query fails
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } catch (Exception $e) {
            // Handle exceptions, redirect with error message
            $privio = "An error occurred while updating records";
            header("Location: ../file.html#?privio=" . urlencode($privio));
        }

        // Close the database connection
        $conn->close();
    }


?>
