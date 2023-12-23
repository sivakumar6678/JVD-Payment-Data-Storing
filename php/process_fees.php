<?php
// Require the database configuration file
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch values from the submitted form
    $TuitionFee = $_POST['TuitionFee'];
    $SpecialFee = $_POST["SpecialFee"];
    $UCSFees = $_POST["UCSFees"];
    $yearSelection = $_POST["yearSelection"];

    try {
        // Retrieve the existing fee details for the selected year
        $selectCurrentYearSQL = "SELECT `Tution_fee`, `Special_fee`, `UCS_fee` FROM studentdetails WHERE `Year` = '$yearSelection'";
        $result = $conn->query($selectCurrentYearSQL);

        // Fetch current year's fee details
        $currentFees = [];
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentFees['Tuition_fee'] = $row['Tution_fee'];
            $currentFees['Special_fee'] = $row['Special_fee'];
            $currentFees['UCS_fee'] = $row['UCS_fee'];

            // Add the new fees to the existing fees for the selected year
            $TuitionFee += $currentFees['Tuition_fee'];
            $SpecialFee += $currentFees['Special_fee'];
            $UCSFees += $currentFees['UCS_fee'];
        }

        // Prepare and execute the SQL query to update the fee details for the selected year
        $sql = "UPDATE studentdetails 
                SET `Tution_fee` = '$TuitionFee', 
                    `Special_fee` = '$SpecialFee', 
                    `UCS_fee` = '$UCSFees'
                WHERE `Year` = '$yearSelection'";

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
