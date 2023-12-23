<?php
// Require the database configuration file
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch values from the submitted form
    $AdmissionFee = $_POST["AdmissionFee"];
    $yearSelection = $_POST["yearSelection"];

    try {
        // Retrieve the existing Admission Fee for the selected year
        $selectCurrentYearSQL = "SELECT `Admission_Fees` FROM studentdetails WHERE `Year` = '$yearSelection'";
        $result = $conn->query($selectCurrentYearSQL);

        // Fetch current year's Admission Fee
        $currentAdmissionFee = 0;
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentAdmissionFee = $row['Admission_Fees'];
        }

        // Add the new Admission Fee to the existing Admission Fee for the selected year
        $AdmissionFee += $currentAdmissionFee;

        // Prepare and execute the SQL query to update the fee details for the selected year
        $sql = "UPDATE studentdetails 
                SET `Admission_Fees` = '$AdmissionFee'
                WHERE `Year` = '$yearSelection' AND `Admission_Number` LIKE '%KA5A%'";

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
